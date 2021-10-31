<?php

namespace Shopph\Application\Contract\Command;

use Shopph\Application\Product\Command\StoreProduct;

interface StoreProductHandlerInterface
{
    public function execute(StoreProduct $command): void;
}
