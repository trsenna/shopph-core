<?php

namespace Shopph\Tests\Application\Sale\Query;

use PHPUnit\Framework\TestCase;
use Shopph\Application\Sale\Query\GetSaleResponse;

final class GetSaleResponseTest extends TestCase
{
    private ?\stdClass $sale;

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

        $this->sale = new \stdClass;
        $this->sale->id = '87ffd646-9ef8-473b-951c-28f53fe8cadc';
        $this->sale->product = $product;
        $this->sale->employee = $employee;
        $this->sale->customer = $customer;
        $this->sale->price = 7.6;
        $this->sale->date = new \DateTime();
    }

    public function testFromObject__MustReturnSale(): void
    {
        $response = GetSaleResponse::fromObject($this->sale);
        $this->assertInstanceOf(GetSaleResponse::class, $response);
        $this->assertNotNull($response->sale);
    }

    public function testFromObject__MustReturnSaleWithId(): void
    {
        $response = GetSaleResponse::fromObject($this->sale);
        $this->assertEquals($this->sale->id, $response->sale->id);
    }

    public function testFromObject__MustReturnSaleWithProduct(): void
    {
        $response = GetSaleResponse::fromObject($this->sale);
        $this->assertSame($this->sale->product, $response->sale->product);
    }

    public function testFromObject__MustReturnSaleWithEmployee(): void
    {
        $response = GetSaleResponse::fromObject($this->sale);
        $this->assertSame($this->sale->employee, $response->sale->employee);
    }

    public function testFromObject__MustReturnSaleWithCustomer(): void
    {
        $response = GetSaleResponse::fromObject($this->sale);
        $this->assertSame($this->sale->customer, $response->sale->customer);
    }

    public function testFromObject__MustReturnSaleWithPrice(): void
    {
        $response = GetSaleResponse::fromObject($this->sale);
        $this->assertEquals($this->sale->price, $response->sale->price);
    }

    public function testFromObject__MustReturnSaleWithDate(): void
    {
        $response = GetSaleResponse::fromObject($this->sale);
        $this->assertEquals($this->sale->date, $response->sale->date);
    }
}
