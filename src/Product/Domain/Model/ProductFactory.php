<?php

namespace Shopph\Product\Domain\Model;

use Shopph\Contract\Product\Domain\Model\ProductFactoryInterface;
use Shopph\Contract\Shared\Model\IdentityFactoryInterface;

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
