<?php

namespace Shopph\Customer\Application\Query;

final class GetCustomerResponse
{
    public \stdClass $customer;

    public static function fromObject(\stdClass $customer): GetCustomerResponse
    {
        $response = new static();
        $response->customer = $customer;

        return $response;
    }
}
