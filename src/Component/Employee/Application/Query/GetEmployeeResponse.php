<?php

namespace Shopph\Employee\Application\Query;

final class GetEmployeeResponse
{
    public \stdClass $employee;

    public static function fromObject(\stdClass $employee): GetEmployeeResponse
    {
        $response = new static();
        $response->employee = $employee;

        return $response;
    }
}
