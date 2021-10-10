<?php

namespace Shopph\Domain\Employee\Model;

use Shopph\Contract\Shared\Model\IdentityFactoryInterface;
use Shopph\Domain\Contract\Model\EmployeeFactoryInterface;

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
