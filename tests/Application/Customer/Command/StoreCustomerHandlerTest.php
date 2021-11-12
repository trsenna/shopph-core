<?php

namespace Shopph\Tests\Application\Customer\Command;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Shopph\Application\Customer\Command\StoreCustomer;
use Shopph\Application\Customer\Command\StoreCustomerHandler;
use Shopph\Application\Customer\Event\StoredCustomer;
use Shopph\Domain\Contract\Model\CustomerFactoryInterface;
use Shopph\Domain\Contract\Model\CustomerRepositoryInterface;
use Shopph\Domain\Customer\Model\Customer;
use Shopph\Domain\Customer\Model\CustomerName;
use Shopph\Shared\Contract\Event\DispatcherInterface;

final class StoreCustomerHandlerTest extends TestCase
{
    private ?MockObject $customerFactory;
    private ?MockObject $customerRepository;
    private ?MockObject $dispatcher;

    private ?StoreCustomer $command;
    private ?StoreCustomerHandler $commandHandler;

    private ?MockObject $customer;

    public function setUp(): void
    {
        $this->customerFactory = $this->createMock(CustomerFactoryInterface::class);
        $this->customerRepository = $this->createMock(CustomerRepositoryInterface::class);
        $this->dispatcher = $this->createMock(DispatcherInterface::class);

        $this->command = new StoreCustomer();
        $this->command->name = 'Jon';

        $reflection = new \ReflectionClass(StoreCustomerHandler::class);
        $this->commandHandler = $reflection->newInstance(
            $this->customerFactory,
            $this->customerRepository,
            $this->dispatcher
        );

        $customerName = $this->createMock(CustomerName::class);
        $customerName->method('getFullName')->willReturn('Jon');

        $this->customer = $this->createMock(Customer::class);
        $this->customer->method('getName')->willReturn($customerName);
    }

    public function testExecute__MustCreateCustomer(): void
    {
        $this->customerFactory->expects($this->once())
            ->method('create')
            ->with($this->command->name)
            ->willReturn($this->customer);

        $this->commandHandler->execute($this->command);
    }

    public function testExecute__MustAddAddCustomer(): void
    {
        $this->customerFactory->method('create')->willReturn($this->customer);
        $this->customerRepository->expects($this->once())->method('add')->with($this->customer);

        $this->commandHandler->execute($this->command);
    }

    public function testExecute__MustDispatchEvent(): void
    {
        $this->customerFactory->method('create')->willReturn($this->customer);
        $this->dispatcher->expects($this->once())
            ->method('dispatch')
            ->with($this->isInstanceOf(StoredCustomer::class));

        $this->commandHandler->execute($this->command);
    }
}
