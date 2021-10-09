<?php

namespace Shopph\Tests\Employee\Application\Query;

use PHPUnit\Framework\TestCase;
use Shopph\Employee\Application\Query\GetEmployeeResponse;

final class GetEmployeeResponseTest extends TestCase
{
    private ?\stdClass $employee;

    public function setUp(): void
    {
        $this->employee = new \stdClass;
        $this->employee->id = '87ffd646-9ef8-473b-951c-28f53fe8cadc';
        $this->employee->name = 'Jon';
    }

    public function testFromObjectWhenCalledMustReturnValidInstance(): void
    {
        $response = GetEmployeeResponse::fromObject($this->employee);
        $this->assertEquals('87ffd646-9ef8-473b-951c-28f53fe8cadc', $response->employee->id);
        $this->assertEquals('Jon', $response->employee->name);
    }
}
