<?php

namespace Shopph\Domain\Employee\Model;

use Shopph\Domain\Contract\Model\EmployeeFactoryInterface;
use Shopph\Shared\Contract\Model\IdentityFactoryInterface;

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
