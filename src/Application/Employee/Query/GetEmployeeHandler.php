<?php

namespace Shopph\Application\Employee\Query;

use Shopph\Application\Contract\Query\GetEmployeeHandlerInterface;
use Shopph\Domain\Contract\Model\EmployeeFinderInterface;

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
