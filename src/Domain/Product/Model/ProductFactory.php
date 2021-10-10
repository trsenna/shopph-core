<?php

namespace Shopph\Domain\Product\Model;

use Shopph\Contract\Shared\Model\IdentityFactoryInterface;
use Shopph\Domain\Contract\Model\ProductFactoryInterface;

final class ProductFactory implements ProductFactoryInterface
{
    private IdentityFactoryInterface $identityFactory;

    public function __construct(IdentityFactoryInterface $identityFactory)
    {
        $this->identityFactory = $identityFactory;
    }

    public function create(string $name, float $price): Product
    {
        $identity = $this->identityFactory->create();
        return new Product($identity, $name, new ProductPrice($price));
    }
}
