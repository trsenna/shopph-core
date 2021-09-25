<?php

namespace Shopph\Application\Customer\Query;

final class GetCustomerResponse
{
    public \stdClass $customer;

    public static function fromObject(\stdClass $customer): GetCustomerResponse
    {
        $response = new self();
        $response->customer = $customer;

        return $response;
    }
}
