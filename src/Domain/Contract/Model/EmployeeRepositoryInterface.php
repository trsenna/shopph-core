<?php

namespace Shopph\Domain\Contract\Model;

use Shopph\Contract\Shared\Model\RepositoryInterface;
use Shopph\Domain\Employee\Model\Employee;

interface EmployeeRepositoryInterface extends RepositoryInterface
{
    public function add(Employee $employee): void;
}
