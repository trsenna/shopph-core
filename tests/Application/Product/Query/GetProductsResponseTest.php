<?php

namespace Shopph\Tests\Application\Product\Query;

use PHPUnit\Framework\TestCase;
use Shopph\Application\Product\Query\GetProductsResponse;

final class GetProductsResponseTest extends TestCase
{
    private ?array $products;

    public function setUp(): void
    {
        $this->products[0] = new \stdClass;
        $this->products[0]->id = '87ffd646-9ef8-473b-951c-28f53fe8cadc';
        $this->products[0]->name = 'Jon';
        $this->products[0]->price = 7.6;
    }

    public function testFromArray__MustReturnProducts(): void
    {
        $response = GetProductsResponse::fromArray($this->products);
        $this->assertInstanceOf(GetProductsResponse::class, $response);
        $this->assertNotEmpty($response->products);
    }

    public function testFromArray__MustReturnProductsWithFirstHavingId(): void
    {
        $response = GetProductsResponse::fromArray($this->products);
        $this->assertEquals($this->products[0]->id, $response->products[0]->id);
    }

    public function testFromArray__MustReturnProductsWithFirstHavingName(): void
    {
        $response = GetProductsResponse::fromArray($this->products);
        $this->assertEquals($this->products[0]->name, $response->products[0]->name);
    }

    public function testFromArray__MustReturnProductsWithFirstHavingPrice(): void
    {
        $response = GetProductsResponse::fromArray($this->products);
        $this->assertEquals($this->products[0]->price, $response->products[0]->price);
    }
}
