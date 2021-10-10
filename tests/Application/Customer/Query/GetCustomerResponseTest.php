<?php

namespace Shopph\Tests\Application\Customer\Query;

use PHPUnit\Framework\TestCase;
use Shopph\Application\Customer\Query\GetCustomerResponse;

final class GetCustomerResponseTest extends TestCase
{
    private ?\stdClass $customer;

    public function setUp(): void
    {
        $this->customer = new \stdClass;
        $this->customer->id = '87ffd646-9ef8-473b-951c-28f53fe8cadc';
        $this->customer->name = 'Jon';
    }

    public function testFromObjectWhenCalledMustReturnValidInstance(): void
    {
        $response = GetCustomerResponse::fromObject($this->customer);
        $this->assertEquals('87ffd646-9ef8-473b-951c-28f53fe8cadc', $response->customer->id);
        $this->assertEquals('Jon', $response->customer->name);
    }
}
