<?php

namespace Shopph\Domain\Contract\Model;

use Shopph\Contract\Shared\Model\RepositoryInterface;
use Shopph\Domain\Product\Model\Product;

interface ProductRepositoryInterface extends RepositoryInterface
{
    public function add(Product $product): void;
}
