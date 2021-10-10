<?php

namespace Shopph\Domain\Contract\Model;

use Shopph\Domain\Employee\Model\Employee;

interface EmployeeFactoryInterface
{
    public function create(string $name): Employee;
}
