<?php

namespace Shopph\Employee\Domain\Model;

use Shopph\Contract\Employee\Domain\Model\EmployeeFactoryInterface;
use Shopph\Contract\Foundation\Model\IdentityFactoryInterface;

final class EmployeeFactory implements EmployeeFactoryInterface
{
    private IdentityFactoryInterface $identityFactory;

    public function __construct(IdentityFactoryInterface $identityFactory)
    {
        $this->identityFactory = $identityFactory;
    }

    public function create(string $name): Employee
    {
        $identity = $this->identityFactory->create();
        return new Employee($identity, new EmployeeName($name));
    }
}
