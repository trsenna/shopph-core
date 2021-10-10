<?php

namespace Shopph\Application\Contract\Query;

use Shopph\Application\Employee\Query\GetEmployee;
use Shopph\Application\Employee\Query\GetEmployeeResponse;

interface GetEmployeeHandlerInterface
{
    public function execute(GetEmployee $query): GetEmployeeResponse;
}
