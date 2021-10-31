<?php

namespace Shopph\Domain\Contract\Model;

use Shopph\Domain\Product\Model\Product;
use Shopph\Shared\Contract\Model\RepositoryInterface;

interface ProductRepositoryInterface extends RepositoryInterface
{
    public function add(Product $product): void;
}
