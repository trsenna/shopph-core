<?php

namespace Shopph\Application\Employee\Command;

use Shopph\Application\Contract\Command\StoreEmployeeHandlerInterface;
use Shopph\Application\Employee\Event\StoredEmployee;
use Shopph\Contract\Shared\Event\DispatcherInterface;
use Shopph\Domain\Contract\Model\EmployeeFactoryInterface;
use Shopph\Domain\Contract\Model\EmployeeRepositoryInterface;

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
