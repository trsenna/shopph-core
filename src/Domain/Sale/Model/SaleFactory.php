<?php

namespace Shopph\Domain\Sale\Model;

use Shopph\Domain\Contract\Model\SaleFactoryInterface;
use Shopph\Domain\Product\Model\Product;
use Shopph\Domain\Employee\Model\Employee;
use Shopph\Domain\Customer\Model\Customer;
use Shopph\Shared\Contract\Model\IdentityFactoryInterface;

final class SaleFactory implements SaleFactoryInterface
{
    private IdentityFactoryInterface $identityFactory;

    public function __construct(IdentityFactoryInterface $identityFactory)
    {
        $this->identityFactory = $identityFactory;
    }

    public function create(Product $product, Employee $employee, Customer $customer, SalePrice $price): Sale
    {
        $now = new \DateTime('NOW');
        $identity = $this->identityFactory->create();

        return new Sale(
            $identity,
            $product->getIdentity(),
            $employee->getIdentity(),
            $customer->getIdentity(),
            $price,
            $now
        );
    }
}
