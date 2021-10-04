<?php

namespace Shopph\Contract\Employee\Application\Query;

use Shopph\Employee\Application\Query\GetEmployees;
use Shopph\Employee\Application\Query\GetEmployeesResponse;

interface GetEmployeesHandlerInterface
{
    public function execute(GetEmployees $query): GetEmployeesResponse;
}
