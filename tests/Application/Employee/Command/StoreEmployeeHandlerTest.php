<?php

namespace Shopph\Tests\Application\Employee\Command;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Shopph\Application\Employee\Command\StoreEmployee;
use Shopph\Application\Employee\Command\StoreEmployeeHandler;
use Shopph\Application\Employee\Event\StoredEmployee;
use Shopph\Domain\Contract\Model\EmployeeFactoryInterface;
use Shopph\Domain\Contract\Model\EmployeeRepositoryInterface;
use Shopph\Domain\Employee\Model\Employee;
use Shopph\Domain\Employee\Model\EmployeeName;
use Shopph\Shared\Contract\Event\DispatcherInterface;

final class StoreEmployeeHandlerTest extends TestCase
{
    private ?MockObject $employeeFactory;
    private ?MockObject $employeeRepository;
    private ?MockObject $dispatcher;

    private ?StoreEmployee $command;
    private ?StoreEmployeeHandler $commandHandler;

    private ?MockObject $employee;

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

        $employeeName = $this->createMock(EmployeeName::class);
        $employeeName->method('getFullName')->willReturn('Jon');

        $this->employee = $this->createMock(Employee::class);
        $this->employee->method('getName')->willReturn($employeeName);
    }

    public function testExecut__MustCreateEmployee(): void
    {
        $this->employeeFactory->expects($this->once())
            ->method('create')
            ->with($this->command->name)
            ->willReturn($this->employee);

        $this->commandHandler->execute($this->command);
    }

    public function testExecute__MustAddEmployee(): void
    {
        $this->employeeFactory->method('create')->willReturn($this->employee);
        $this->employeeRepository->expects($this->once())->method('add')->with($this->employee);

        $this->commandHandler->execute($this->command);
    }

    public function testExecute__MustDispatchEvent(): void
    {
        $this->employeeFactory->method('create')->willReturn($this->employee);
        $this->dispatcher->expects($this->once())
            ->method('dispatch')
            ->with($this->isInstanceOf(StoredEmployee::class));

        $this->commandHandler->execute($this->command);
    }
}
