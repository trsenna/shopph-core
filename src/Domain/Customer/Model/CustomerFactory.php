<?php

namespace Shopph\Domain\Customer\Model;

use Shopph\Contract\Shared\Model\IdentityFactoryInterface;
use Shopph\Domain\Contract\Model\CustomerFactoryInterface;

final class CustomerFactory implements CustomerFactoryInterface
{
    private IdentityFactoryInterface $identityFactory;

    public function __construct(IdentityFactoryInterface $identityFactory)
    {
        $this->identityFactory = $identityFactory;
    }

    public function create(string $name): Customer
    {
        $identity = $this->identityFactory->create();
        return new Customer($identity, new CustomerName($name));
    }
}
