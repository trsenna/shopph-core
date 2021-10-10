<?php

namespace Shopph\Tests\Application\Customer\Query;

use PHPUnit\Framework\TestCase;
use Shopph\Application\Customer\Query\GetCustomersResponse;

final class GetCustomersResponseTest extends TestCase
{
    private ?array $customers;

    public function setUp(): void
    {
        $this->customers[0] = new \stdClass;
        $this->customers[0]->id = '87ffd646-9ef8-473b-951c-28f53fe8cadc';
        $this->customers[0]->name = 'Jon';
    }

    public function testFromArrayWhenCalledMustReturnValidInstances(): void
    {
        $response = GetCustomersResponse::fromArray($this->customers);
        $this->assertNotEmpty($response->customers);
        $this->assertEquals('87ffd646-9ef8-473b-951c-28f53fe8cadc', $response->customers[0]->id);
        $this->assertEquals('Jon', $response->customers[0]->name);
    }
}
