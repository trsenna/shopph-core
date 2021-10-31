<?php

namespace Shopph\Tests\Application\Product\Command;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Shopph\Application\Contract\Command\StoreSaleHandlerInterface;
use Shopph\Application\Sale\Command\StoreSale;
use Shopph\Application\Sale\Command\StoreSaleHandler;
use Shopph\Domain\Contract\Model\CustomerRepositoryInterface;
use Shopph\Domain\Contract\Model\EmployeeRepositoryInterface;
use Shopph\Domain\Contract\Model\ProductRepositoryInterface;
use Shopph\Domain\Contract\Model\SaleFactoryInterface;
use Shopph\Domain\Contract\Model\SaleRepositoryInterface;
use Shopph\Domain\Customer\Model\Customer;
use Shopph\Domain\Employee\Model\Employee;
use Shopph\Domain\Product\Model\Product;
use Shopph\Shared\Contract\Event\DispatcherInterface;
use Shopph\Shared\Contract\Model\IdentityFactoryInterface;
use Shopph\Shared\Verification\VerifyException;
use Shopph\Tests\Shared\Faker\IdentityFakerTrait;

final class StoreSaleHandlerTest extends TestCase
{
    use IdentityFakerTrait;

    private ?MockObject $identityFactoryMock;
    private ?MockObject $saleFactoryMock;
    private ?MockObject $productRepositoryMock;
    private ?MockObject $employeeRepositoryMock;
    private ?MockObject $customerRepositoryMock;
    private ?MockObject $saleRepositoryMock;
    private ?MockObject $dispatcherMock;

    private ?StoreSale $command;
    private ?StoreSaleHandlerInterface $commandHandler;

    private ?MockObject $productMock;
    private ?MockObject $employeeMock;
    private ?MockObject $customerMock;

    public function setUp(): void
    {
        $this->identityFactoryMock = $this->createMock(IdentityFactoryInterface::class);
        $this->saleFactoryMock = $this->createMock(SaleFactoryInterface::class);
        $this->productRepositoryMock = $this->createMock(ProductRepositoryInterface::class);
        $this->employeeRepositoryMock = $this->createMock(EmployeeRepositoryInterface::class);
        $this->customerRepositoryMock = $this->createMock(CustomerRepositoryInterface::class);
        $this->saleRepositoryMock = $this->createMock(SaleRepositoryInterface::class);
        $this->dispatcherMock = $this->createMock(DispatcherInterface::class);

        $this->command = new StoreSale();
        $this->command->productId = '32218f4d-434f-4249-9ac6-725d555f2ce2';
        $this->command->employeeId = '6c5ab5a2-5025-4894-8e97-a1458f5b2e15';
        $this->command->customerId = '6f0885c0-58f2-4a5f-b9bc-2df3549cfe03';
        $this->command->unitPrice = 4.5;
        $this->command->quantity = 2;

        $reflection = new \ReflectionClass(StoreSaleHandler::class);
        $this->commandHandler = $reflection->newInstance(
            $this->productRepositoryMock,
            $this->employeeRepositoryMock,
            $this->customerRepositoryMock,
            $this->saleRepositoryMock,
            $this->identityFactoryMock,
            $this->saleFactoryMock,
            $this->dispatcherMock
        );

        $this->productMock = $this->createMock(Product::class);
        $this->employeeMock = $this->createMock(Employee::class);
        $this->customerMock = $this->createMock(Customer::class);

        $this->identityFactoryMock
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
    }

    public function testExecute__MustCreateRelatedIdentities(): void
    {
        $this->productRepositoryMock->method('ofIdentity')->willReturn($this->productMock);
        $this->employeeRepositoryMock->method('ofIdentity')->willReturn($this->employeeMock);
        $this->customerRepositoryMock->method('ofIdentity')->willReturn($this->customerMock);

        $this->identityFactoryMock
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
        $this->employeeRepositoryMock->method('ofIdentity')->willReturn($this->employeeMock);
        $this->customerRepositoryMock->method('ofIdentity')->willReturn($this->customerMock);

        $productIdentity = $this->fakeIdentity($this->command->productId);
        $this->productRepositoryMock->expects($this->once())->method('ofIdentity')
            ->with($productIdentity)->willReturn($this->productMock);

        $this->commandHandler->execute($this->command);
    }

    public function testExecute__MustFindEmployeeByIdentity(): void
    {
        $this->productRepositoryMock->method('ofIdentity')->willReturn($this->productMock);
        $this->customerRepositoryMock->method('ofIdentity')->willReturn($this->customerMock);

        $employeeIdentity = $this->fakeIdentity($this->command->employeeId);
        $this->employeeRepositoryMock->expects($this->once())->method('ofIdentity')
            ->with($employeeIdentity)->willReturn($this->employeeMock);

        $this->commandHandler->execute($this->command);
    }

    public function testExecute__MustFindCustomerByIdentity(): void
    {
        $this->productRepositoryMock->method('ofIdentity')->willReturn($this->productMock);
        $this->employeeRepositoryMock->method('ofIdentity')->willReturn($this->employeeMock);

        $customerIdentity = $this->fakeIdentity($this->command->customerId);
        $this->customerRepositoryMock->expects($this->once())->method('ofIdentity')
            ->with($customerIdentity)->willReturn($this->customerMock);

        $this->commandHandler->execute($this->command);
    }

    public function testExecute__WhenNoProductFoundMustThrowException(): void
    {
        $this->productRepositoryMock->method('ofIdentity')->willreturn(null);
        $this->employeeRepositoryMock->method('ofIdentity')->willReturn($this->employeeMock);
        $this->customerRepositoryMock->method('ofIdentity')->willReturn($this->customerMock);

        try {
            $this->commandHandler->execute($this->command);
            $this->fail();
        } catch (VerifyException $e) {
            $this->assertStringContainsString('no product found', $e->getMessage());
        }
    }

    public function testExecute__WhenNoEmployeeFoundMustThrowException(): void
    {
        $this->productRepositoryMock->method('ofIdentity')->willReturn($this->productMock);
        $this->employeeRepositoryMock->method('ofIdentity')->willreturn(null);
        $this->customerRepositoryMock->method('ofIdentity')->willReturn($this->customerMock);

        try {
            $this->commandHandler->execute($this->command);
            $this->fail();
        } catch (VerifyException $e) {
            $this->assertStringContainsString('no employee found', $e->getMessage());
        }
    }

    public function testExecute__WhenNoCustomerFoundMustThrowException(): void
    {
        $this->productRepositoryMock->method('ofIdentity')->willReturn($this->productMock);
        $this->employeeRepositoryMock->method('ofIdentity')->willReturn($this->employeeMock);
        $this->customerRepositoryMock->method('ofIdentity')->willreturn(null);

        try {
            $this->commandHandler->execute($this->command);
            $this->fail();
        } catch (VerifyException $e) {
            $this->assertStringContainsString('no customer found', $e->getMessage());
        }
    }

    // public function testExecute__MustFindByRelatedIdentities(): void
    // {
    //     $this->identityFactoryMock
    //         ->method('valueOf')
    //         ->withConsecutive(
    //             [$this->command->productId],
    //             [$this->command->employeeId],
    //             [$this->command->customerId],
    //         )
    //         ->willReturnOnConsecutiveCalls(
    //             $this->fakeIdentity($this->command->productId),
    //             $this->fakeIdentity($this->command->employeeId),
    //             $this->fakeIdentity($this->command->customerId)
    //         );

    //     $this->productRepositoryMock->expects($this->once())->method('ofIdentity')->with($this->fakeIdentity($this->command->productId));
    //     $this->employeeRepositoryMock->expects($this->once())->method('ofIdentity')->with($this->fakeIdentity($this->command->employeeId));
    //     $this->customerRepositoryMock->expects($this->once())->method('ofIdentity')->with($this->fakeIdentity($this->command->customerId));

    //     $this->commandHandler->execute($this->command);
    // }

    // public function testExecute__MustCreateProduct(): void
    // {
    //     $product = $this->createMock(Product::class);
    //     $this->productFactoryMock->expects($this->once())
    //         ->method('create')
    //         ->with($this->command->name, $this->command->price)
    //         ->willReturn($product);

    //     $this->commandHandler->execute($this->command);
    // }

    // public function testExecute__MustAddProduct(): void
    // {
    //     $product = $this->createMock(Product::class);
    //     $this->productFactoryMock->method('create')->willReturn($product);
    //     $this->productRepositoryMock->expects($this->once())->method('add')->with($product);

    //     $this->commandHandler->execute($this->command);
    // }

    // public function testExecute__MustDispatchEvent(): void
    // {
    //     $product = $this->createMock(Product::class);
    //     $this->productFactoryMock->method('create')->willReturn($product);
    //     $this->dispatcherMock->expects($this->once())->method('dispatch');

    //     $this->commandHandler->execute($this->command);
    // }
}
