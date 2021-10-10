<?php

namespace Shopph\Domain\Contract\Model;

use Shopph\Domain\Product\Model\Product;

interface ProductFactoryInterface
{
    public function create(string $name, float $price): Product;
}
