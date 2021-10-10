<?php

namespace Shopph\Tests\Customer\Application\Command;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Shopph\Contract\Shared\Event\DispatcherInterface;
use Shopph\Customer\Application\Command\StoreCustomer;
use Shopph\Customer\Application\Command\StoreCustomerHandler;
use Shopph\Domain\Contract\Model\CustomerFactoryInterface;
use Shopph\Domain\Contract\Model\CustomerRepositoryInterface;
use Shopph\Domain\Customer\Model\Customer;
use Shopph\Domain\Customer\Model\CustomerName;
use Shopph\Tests\Shared\Faker\IdentityFakerTrait;

final class StoreCustomerHandlerTest extends TestCase
{
    use IdentityFakerTrait;

    private ?StoreCustomer $command;
    private ?StoreCustomerHandler $commandHandler;
    private ?Customer $customer;

    private ?MockObject $customerFactory;
    private ?MockObject $customerRepository;
    private ?MockObject $dispatcher;

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

        $this->customer = new Customer(
            $this->fakeIdentity('87ffd646-9ef8-473b-951c-28f53fe8cadc'),
            new CustomerName('Jon')
        );
    }

    public function testExecuteWhenCalledMustCreateEntity(): void
    {
        $this->customerFactory->expects($this->once())->method('create')->willReturn($this->customer);
        $this->commandHandler->execute($this->command);
    }

    public function testExecuteWhenCalledMustAddCustomer(): void
    {
        $this->customerFactory->method('create')->willReturn($this->customer);
        $this->customerRepository->expects($this->once())->method('add')->with($this->customer);
        $this->commandHandler->execute($this->command);
    }

    public function testExecuteWhenCalledMustDispatchEvent(): void
    {
        $this->customerFactory->method('create')->willReturn($this->customer);
        $this->dispatcher->expects($this->once())->method('dispatch');
        $this->commandHandler->execute($this->command);
    }
}
