<?php

namespace Shopph\Employee\Application\Command;

use Shopph\Contract\Employee\Application\Command\StoreEmployeeHandlerInterface;
use Shopph\Contract\Employee\Domain\Model\EmployeeFactoryInterface;
use Shopph\Contract\Employee\Domain\Model\EmployeeRepositoryInterface;
use Shopph\Contract\Foundation\Event\DispatcherInterface;
use Shopph\Employee\Application\Event\StoredEmployee;

final class StoreEmployeeHandler implements StoreEmployeeHandlerInterface
{
    private EmployeeFactoryInterface $employeeFactory;
    private EmployeeRepositoryInterface $employeeRepository;
    private DispatcherInterface $dispatcher;

    public function __construct(
        EmployeeFactoryInterface $employeeFactory,
        EmployeeRepositoryInterface $employeeRepository,
        DispatcherInterface $dispatcher
    ) {
        $this->employeeFactory = $employeeFactory;
        $this->employeeRepository = $employeeRepository;
        $this->dispatcher = $dispatcher;
    }

    public function execute(StoreEmployee $command): void
    {
        $employee = $this->employeeFactory->create($command->name);
        $this->employeeRepository->add($employee);

        $this->dispatcher->dispatch(
            StoredEmployee::fromEntity($employee)
        );
    }
}
