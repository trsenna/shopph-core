<?php

namespace Shopph\Domain\Contract\Model;

use Shopph\Domain\Employee\Model\Employee;
use Shopph\Shared\Contract\Model\RepositoryInterface;

interface EmployeeRepositoryInterface extends RepositoryInterface
{
    public function add(Employee $employee): void;
}
