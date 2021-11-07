<?php

namespace Shopph\Application\Contract\Query;

use Shopph\Application\Product\Query\GetProducts;
use Shopph\Application\Product\Query\GetProductsResponse;

interface GetProductsHandlerInterface
{
    public function execute(GetProducts $query): GetProductsResponse;
}
