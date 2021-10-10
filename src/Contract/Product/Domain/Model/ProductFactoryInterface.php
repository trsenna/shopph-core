<?php

namespace Shopph\Contract\Product\Domain\Model;

use Shopph\Product\Domain\Model\Product;

interface ProductFactoryInterface
{
    public function create(string $name, float $price): Product;
}
