<?php

namespace Shopph\Customer\Application\Query;

final class GetCustomersResponse
{
    public array $customers = [];

    public static function fromArray(array $customers): GetCustomersResponse
    {
        $response = new static();
        $response->customers = $customers;

        return $response;
    }
}
