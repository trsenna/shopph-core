<?php

namespace Shopph\Application\Product\Query;

final class GetProductsResponse
{
    public array $products = [];

    public static function fromArray(array $products): GetProductsResponse
    {
        $response = new static();
        $response->products = $products;

        return $response;
    }
}
