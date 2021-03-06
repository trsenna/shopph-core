<?php

namespace Shopph\Tests\Application\Employee\Command;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Shopph\Application\Employee\Command\StoreEmployee;
use Shopph\Application\Employee\Command\StoreEmployeeHandler;
use Shopph\Domain\Contract\Model\EmployeeFactoryInterface;
use Shopph\Domain\Contract\Model\EmployeeRepositoryInterface;
use Shopph\Domain\Employee\Model\Employee;
use Shopph\Domain\Employee\Model\EmployeeName;
use Shopph\Shared\Contract\Event\DispatcherInterface;
use Shopph\Tests\Shared\Faker\IdentityFakerTrait;

final class StoreEmployeeHandlerTest extends TestCase
{
    use IdentityFakerTrait;

    private ?StoreEmployee $command;
    private ?StoreEmployeeHandler $commandHandler;
    private ?Employee $employee;

    private ?MockObject $employeeFactory;
    private ?MockObject $employeeRepository;
    private ?MockObject $dispatcher;

    public function setUp(): void
    {
        $this->employeeFactory = $this->createMock(EmployeeFactoryInterface::class);
        $this->employeeRepository = $this->createMock(EmployeeRepositoryInterface::class);
        $this->dispatcher = $this->createMock(DispatcherInterface::class);

        $this->command = new StoreEmployee();
        $this->command->name = 'Jon';

        $reflection = new \ReflectionClass(StoreEmployeeHandler::class);
        $this->commandHandler = $reflection->newInstance(
            $this->employeeFactory,
            $this->employeeRepository,
            $this->dispatcher
        );

        $this->employee = new Employee(
            $this->fakeIdentity('87ffd646-9ef8-473b-951c-28f53fe8cadc'),
            new EmployeeName('Jon')
        );
    }

    public function testExecuteWhenCalledMustCreateEntity(): void
    {
        $this->employeeFactory->expects($this->once())->method('create')->willReturn($this->employee);
        $this->commandHandler->execute($this->command);
    }

    public function testExecuteWhenCalledMustAddEmployee(): void
    {
        $this->employeeFactory->method('create')->willReturn($this->employee);
        $this->employeeRepository->expects($this->once())->method('add')->with($this->employee);
        $this->commandHandler->execute($this->command);
    }

    public function testExecuteWhenCalledMustDispatchEvent(): void
    {
        $this->employeeFactory->method('create')->willReturn($this->employee);
        $this->dispatcher->expects($this->once())->method('dispatch');
        $this->commandHandler->execute($this->command);
    }
}
