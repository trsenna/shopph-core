<?php

namespace Shopph\Application\Sale\Query;

final class GetSalesResponse
{
    public array $sales = [];

    public static function fromArray(array $sales): GetSalesResponse
    {
        $response = new static();
        $response->sales = $sales;

        return $response;
    }
}
