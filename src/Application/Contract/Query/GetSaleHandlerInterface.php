<?php

namespace Shopph\Application\Contract\Query;

use Shopph\Application\Sale\Query\GetSale;
use Shopph\Application\Sale\Query\GetSaleResponse;

interface GetSaleHandlerInterface
{
    public function execute(GetSale $query): GetSaleResponse;
}
