<?php

namespace Shopph\Application\Employee\Query;

use Shopph\Application\Contract\Query\GetEmployeesHandlerInterface;
use Shopph\Domain\Contract\Model\EmployeeFinderInterface;

final class GetEmployeesHandler implements GetEmployeesHandlerInterface
{
    private EmployeeFinderInterface $employeeFinder;

    public function __construct(EmployeeFinderInterface $employeeFinder)
    {
        $this->employeeFinder = $employeeFinder;
    }

    public function execute(GetEmployees $query): GetEmployeesResponse
    {
        return GetEmployeesResponse::fromArray(
            $this->employeeFinder->findAll()
        );
    }
}
