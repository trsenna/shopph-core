<?php

namespace Shopph\Application\Contract\Query;

use Shopph\Application\Sale\Query\GetSales;
use Shopph\Application\Sale\Query\GetSalesResponse;

interface GetSalesHandlerInterface
{
    public function execute(GetSales $query): GetSalesResponse;
}
