<?php

namespace Shopph\Tests\Application\Sale\Query;

use PHPUnit\Framework\TestCase;
use Shopph\Application\Sale\Query\GetSalesResponse;

final class GetSalesResponseTest extends TestCase
{
    private ?array $sales;

    public function setUp(): void
    {
        $product = new \stdClass;
        $product->id = '32218f4d-434f-4249-9ac6-725d555f2ce2';
        $product->name = 'product #1';
        $product->price = 7.6;

        $employee = new \stdClass;
        $employee->id = '6c5ab5a2-5025-4894-8e97-a1458f5b2e15';
        $employee->name = 'employee #1';

        $customer = new \stdClass;
        $customer->id = '6f0885c0-58f2-4a5f-b9bc-2df3549cfe03';
        $customer->name = 'customer #1';

        $this->sales[0] = new \stdClass;
        $this->sales[0]->id = '87ffd646-9ef8-473b-951c-28f53fe8cadc';
        $this->sales[0]->product = $product;
        $this->sales[0]->employee = $employee;
        $this->sales[0]->customer = $customer;
        $this->sales[0]->price = 7.6;
        $this->sales[0]->date = new \DateTime();
    }

    public function testFromArray__MustReturnSales(): void
    {
        $response = GetSalesResponse::fromArray($this->sales);
        $this->assertInstanceOf(GetSalesResponse::class, $response);
        $this->assertNotEmpty($response->sales);
    }

    public function testFromArray__MustReturnSalesWithFirstHavingId(): void
    {
        $response = GetSalesResponse::fromArray($this->sales);
        $this->assertEquals($this->sales[0]->id, $response->sales[0]->id);
    }

    public function testFromArray__MustReturnSalesWithFirstHavingProduct(): void
    {
        $response = GetSalesResponse::fromArray($this->sales);
        $this->assertSame($this->sales[0]->product, $response->sales[0]->product);
    }

    public function testFromArray__MustReturnSalesWithFirstHavingEmployee(): void
    {
        $response = GetSalesResponse::fromArray($this->sales);
        $this->assertSame($this->sales[0]->employee, $response->sales[0]->employee);
    }

    public function testFromArray__MustReturnSalesWithFirstHavingCustomer(): void
    {
        $response = GetSalesResponse::fromArray($this->sales);
        $this->assertSame($this->sales[0]->customer, $response->sales[0]->customer);
    }

    public function testFromArray__MustReturnSalesWithFirstHavingPrice(): void
    {
        $response = GetSalesResponse::fromArray($this->sales);
        $this->assertSame($this->sales[0]->price, $response->sales[0]->price);
    }

    public function testFromArray__MustReturnSalesWithFirstHavingDate(): void
    {
        $response = GetSalesResponse::fromArray($this->sales);
        $this->assertSame($this->sales[0]->date, $response->sales[0]->date);
    }
}
