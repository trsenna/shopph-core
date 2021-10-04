<?php

namespace Shopph\Employee\Application\Query;

final class GetEmployeesResponse
{
    public array $employees = [];

    public static function fromArray(array $employees): GetEmployeesResponse
    {
        $response = new static();
        $response->employees = $employees;

        return $response;
    }
}
