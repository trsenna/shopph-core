<?php

namespace Shopph\Contract\Employee\Application\Query;

use Shopph\Employee\Application\Query\GetEmployee;
use Shopph\Employee\Application\Query\GetEmployeeResponse;

interface GetEmployeeHandlerInterface
{
    public function execute(GetEmployee $query): GetEmployeeResponse;
}
