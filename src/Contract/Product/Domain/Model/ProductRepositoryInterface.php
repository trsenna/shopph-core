<?php

namespace Shopph\Contract\Product\Domain\Model;

use Shopph\Contract\Shared\Model\RepositoryInterface;
use Shopph\Product\Domain\Model\Product;

interface ProductRepositoryInterface extends RepositoryInterface
{
    public function add(Product $product): void;
}
