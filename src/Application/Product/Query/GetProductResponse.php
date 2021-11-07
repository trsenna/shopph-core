<?php

namespace Shopph\Application\Product\Query;

final class GetProductResponse
{
    public \stdClass $product;

    public static function fromObject(\stdClass $product): GetProductResponse
    {
        $response = new static();
        $response->product = $product;

        return $response;
    }
}
