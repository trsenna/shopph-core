<?php

namespace Shopph\Application\Sale\Query;

final class GetSaleResponse
{
    public \stdClass $sale;

    public static function fromObject(\stdClass $sale): GetSaleResponse
    {
        $response = new static();
        $response->sale = $sale;

        return $response;
    }
}
