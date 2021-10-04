<?php

namespace Shopph\Tests\Employee\Application\Query;

use PHPUnit\Framework\TestCase;
use Shopph\Employee\Application\Query\GetEmployeesResponse;

final class GetEmployeesResponseTest extends TestCase
{
    private ?array $employees;

    public function setUp(): void
    {
        $this->employees[0] = new \stdClass;
        $this->employees[0]->id = '87ffd646-9ef8-473b-951c-28f53fe8cadc';
        $this->employees[0]->name = 'Jon';
    }

    public function testFromArrayWhenCalledMustReturnValidInstances(): void
    {
        $response = GetEmployeesResponse::fromArray($this->employees);
        $this->assertNotEmpty($response->employees);
        $this->assertEquals('87ffd646-9ef8-473b-951c-28f53fe8cadc', $response->employees[0]->id);
        $this->assertEquals('Jon', $response->employees[0]->name);
    }
}
