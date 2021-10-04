<?php

namespace Shopph\Contract\Employee\Domain\Model;

use Shopph\Contract\Foundation\Model\RepositoryInterface;
use Shopph\Employee\Domain\Model\Employee;

interface EmployeeRepositoryInterface extends RepositoryInterface
{
    public function add(Employee $employee): void;
}
