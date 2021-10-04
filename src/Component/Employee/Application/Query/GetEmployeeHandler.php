<?php

namespace Shopph\Employee\Application\Query;

use Shopph\Contract\Employee\Application\Query\GetEmployeeHandlerInterface;
use Shopph\Contract\Employee\Domain\Model\EmployeeFinderInterface;

final class GetEmployeeHandler implements GetEmployeeHandlerInterface
{
    private EmployeeFinderInterface $employeeFinder;

    public function __construct(EmployeeFinderInterface $employeeFinder)
    {
        $this->employeeFinder = $employeeFinder;
    }

    public function execute(GetEmployee $query): GetEmployeeResponse
    {
        return GetEmployeeResponse::fromObject(
            $this->employeeFinder->findOne($query->id)
        );
    }
}
