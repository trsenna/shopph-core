<?php

namespace Shopph\Application\Contract\Query;

use Shopph\Application\Product\Query\GetProduct;
use Shopph\Application\Product\Query\GetProductResponse;

interface GetProductHandlerInterface
{
    public function execute(GetProduct $query): GetProductResponse;
}
