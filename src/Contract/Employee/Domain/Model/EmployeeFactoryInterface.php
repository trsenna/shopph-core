<?php

namespace Shopph\Contract\Employee\Domain\Model;

use Shopph\Employee\Domain\Model\Employee;

interface EmployeeFactoryInterface
{
    public function create(string $name): Employee;
}
