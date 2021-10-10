<?php

namespace Shopph\Application\Contract\Query;

use Shopph\Application\Employee\Query\GetEmployees;
use Shopph\Application\Employee\Query\GetEmployeesResponse;

interface GetEmployeesHandlerInterface
{
    public function execute(GetEmployees $query): GetEmployeesResponse;
}
