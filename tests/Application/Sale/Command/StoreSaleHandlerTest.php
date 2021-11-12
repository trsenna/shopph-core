<?php

namespace Shopph\Tests\Application\Product\Command;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Shopph\Application\Contract\Command\StoreSaleHandlerInterface;
use Shopph\Application\Sale\Command\StoreSale;
use Shopph\Application\Sale\Command\StoreSaleHandler;
use Shopph\Application\Sale\Event\StoredSale;
use Shopph\Domain\Contract\Model\CustomerRepositoryInterface;
use Shopph\Domain\Contract\Model\EmployeeRepositoryInterface;
use Shopph\Domain\Contract\Model\ProductRepositoryInterface;
use Shopph\Domain\Contract\Model\SaleFactoryInterface;
use Shopph\Domain\Contract\Model\SaleRepositoryInterface;
use Shopph\Domain\Customer\Model\Customer;
use Shopph\Domain\Employee\Model\Employee;
use Shopph\Domain\Product\Model\Product;
use Shopph\Domain\Sale\Model\Sale;
use Shopph\Domain\Sale\Model\SalePrice;
use Shopph\Shared\Contract\Event\DispatcherInterface;
use Shopph\Shared\Contract\Model\IdentityFactoryInterface;
use Shopph\Shared\Verification\VerifyException;
use Shopph\Tests\Shared\Faker\IdentityFakerTrait;

final class StoreSaleHandlerTest extends TestCase
{
    use IdentityFakerTrait;

    private ?MockObject $identityFactory;
    private ?MockObject $saleFactory;
    private ?MockObject $productRepository;
    private ?MockObject $employeeRepository;
    private ?MockObject $customerRepository;
    private ?MockObject $saleRepository;
    private ?MockObject $dispatcher;

    private ?StoreSale $command;
    private ?StoreSaleHandlerInterface $commandHandler;

    private ?MockObject $product;
    private ?MockObject $employee;
    private ?MockObject $customer;

    public function setUp(): void
    {
        $this->identityFactory = $this->createMock(IdentityFactoryInterface::class);
        $this->saleFactory = $this->createMock(SaleFactoryInterface::class);
        $this->productRepository = $this->createMock(ProductRepositoryInterface::class);
        $this->employeeRepository = $this->createMock(EmployeeRepositoryInterface::class);
        $this->customerRepository = $this->createMock(CustomerRepositoryInterface::class);
        $this->saleRepository = $this->createMock(SaleRepositoryInterface::class);
        $this->dispatcher = $this->createMock(DispatcherInterface::class);

        $this->command = new StoreSale();
        $this->command->productId = '32218f4d-434f-4249-9ac6-725d555f2ce2';
        $this->command->employeeId = '6c5ab5a2-5025-4894-8e97-a1458f5b2e15';
        $this->command->customerId = '6f0885c0-58f2-4a5f-b9bc-2df3549cfe03';
        $this->command->unitPrice = 4.5;
        $this->command->quantity = 2;

        $reflection = new \ReflectionClass(StoreSaleHandler::class);
        $this->commandHandler = $reflection->newInstance(
            $this->productRepository,
            $this->employeeRepository,
            $this->customerRepository,
            $this->saleRepository,
            $this->identityFactory,
            $this->saleFactory,
            $this->dispatcher
        );

        $this->identityFactory
            ->method('valueOf')
            ->withConsecutive(
                [$this->command->productId],
                [$this->command->employeeId],
                [$this->command->customerId],
            )
            ->willReturnOnConsecutiveCalls(
                $this->fakeIdentity($this->command->productId),
                $this->fakeIdentity($this->command->employeeId),
                $this->fakeIdentity($this->command->customerId)
            );

        $this->product = $this->createMock(Product::class);
        $this->employee = $this->createMock(Employee::class);
        $this->customer = $this->createMock(Customer::class);
    }

    public function testExecute__MustCreateRelatedIdentities(): void
    {
        $this->productRepository->method('ofIdentity')->willReturn($this->product);
        $this->employeeRepository->method('ofIdentity')->willReturn($this->employee);
        $this->customerRepository->method('ofIdentity')->willReturn($this->customer);

        $this->identityFactory
            ->expects($this->exactly(3))
            ->method('valueOf')
            ->withConsecutive(
                [$this->command->productId],
                [$this->command->employeeId],
                [$this->command->customerId],
            );

        $this->commandHandler->execute($this->command);
    }

    public function testExecute__MustFindProductByIdentity(): void
    {
        $this->employeeRepository->method('ofIdentity')->willReturn($this->employee);
        $this->customerRepository->method('ofIdentity')->willReturn($this->customer);

        $productIdentity = $this->fakeIdentity($this->command->productId);
        $this->productRepository->expects($this->once())->method('ofIdentity')
            ->with($productIdentity)->willReturn($this->product);

        $this->commandHandler->execute($this->command);
    }

    public function testExecute__MustFindEmployeeByIdentity(): void
    {
        $this->productRepository->method('ofIdentity')->willReturn($this->product);
        $this->customerRepository->method('ofIdentity')->willReturn($this->customer);

        $employeeIdentity = $this->fakeIdentity($this->command->employeeId);
        $this->employeeRepository->expects($this->once())->method('ofIdentity')
            ->with($employeeIdentity)->willReturn($this->employee);

        $this->commandHandler->execute($this->command);
    }

    public function testExecute__MustFindCustomerByIdentity(): void
    {
        $this->productRepository->method('ofIdentity')->willReturn($this->product);
        $this->employeeRepository->method('ofIdentity')->willReturn($this->employee);

        $customerIdentity = $this->fakeIdentity($this->command->customerId);
        $this->customerRepository->expects($this->once())->method('ofIdentity')
            ->with($customerIdentity)->willReturn($this->customer);

        $this->commandHandler->execute($this->command);
    }

    public function testExecute__WhenNoProductFoundMustThrowException(): void
    {
        $this->productRepository->method('ofIdentity')->willreturn(null);
        $this->employeeRepository->method('ofIdentity')->willReturn($this->employee);
        $this->customerRepository->method('ofIdentity')->willReturn($this->customer);

        try {
            $this->commandHandler->execute($this->command);
            $this->fail();
        } catch (VerifyException $e) {
            $this->assertStringContainsString('no product found', $e->getMessage());
        }
    }

    public function testExecute__WhenNoEmployeeFoundMustThrowException(): void
    {
        $this->productRepository->method('ofIdentity')->willReturn($this->product);
        $this->employeeRepository->method('ofIdentity')->willreturn(null);
        $this->customerRepository->method('ofIdentity')->willReturn($this->customer);

        try {
            $this->commandHandler->execute($this->command);
            $this->fail();
        } catch (VerifyException $e) {
            $this->assertStringContainsString('no employee found', $e->getMessage());
        }
    }

    public function testExecute__WhenNoCustomerFoundMustThrowException(): void
    {
        $this->productRepository->method('ofIdentity')->willReturn($this->product);
        $this->employeeRepository->method('ofIdentity')->willReturn($this->employee);
        $this->customerRepository->method('ofIdentity')->willreturn(null);

        try {
            $this->commandHandler->execute($this->command);
            $this->fail();
        } catch (VerifyException $e) {
            $this->assertStringContainsString('no customer found', $e->getMessage());
        }
    }

    public function testExecute__MustCreateSale(): void
    {
        $this->productRepository->method('ofIdentity')->willReturn($this->product);
        $this->employeeRepository->method('ofIdentity')->willReturn($this->employee);
        $this->customerRepository->method('ofIdentity')->willreturn($this->customer);

        $this->saleFactory->expects($this->once())
            ->method('create')
            ->with(
                $this->product,
                $this->employee,
                $this->customer,
                $this->isInstanceOf(SalePrice::class)
            );

        $this->commandHandler->execute($this->command);
    }

    public function testExecute__MustAddSale(): void
    {
        $this->productRepository->method('ofIdentity')->willReturn($this->product);
        $this->employeeRepository->method('ofIdentity')->willReturn($this->employee);
        $this->customerRepository->method('ofIdentity')->willreturn($this->customer);

        $sale = $this->createMock(Sale::class);
        $this->saleFactory->method('create')->willReturn($sale);

        $this->saleRepository->expects($this->once())->method('add')->with($sale);

        $this->commandHandler->execute($this->command);
    }

    public function testExecute__MustDispatchEvent(): void
    {
        $this->productRepository->method('ofIdentity')->willReturn($this->product);
        $this->employeeRepository->method('ofIdentity')->willReturn($this->employee);
        $this->customerRepository->method('ofIdentity')->willreturn($this->customer);

        $sale = $this->createMock(Sale::class);
        $this->saleFactory->method('create')->willReturn($sale);

        $this->dispatcher->expects($this->once())
            ->method('dispatch')
            ->with($this->isInstanceOf(StoredSale::class));

        $this->commandHandler->execute($this->command);
    }
}
