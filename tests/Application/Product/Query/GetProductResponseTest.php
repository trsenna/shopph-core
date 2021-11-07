<?php

namespace Shopph\Tests\Application\Product\Query;

use PHPUnit\Framework\TestCase;
use Shopph\Application\Product\Query\GetProductResponse;

final class GetProductResponseTest extends TestCase
{
    private ?\stdClass $product;

    public function setUp(): void
    {
        $this->product = new \stdClass;
        $this->product->id = '87ffd646-9ef8-473b-951c-28f53fe8cadc';
        $this->product->name = 'Jon';
        $this->product->price = 7.6;
    }

    public function testFromObject__MustReturnProduct(): void
    {
        $response = GetProductResponse::fromObject($this->product);
        $this->assertNotNull($response->product);
    }

    public function testFromObject__MustReturnProductWithId(): void
    {
        $response = GetProductResponse::fromObject($this->product);
        $this->assertEquals($this->product->id, $response->product->id);
    }

    public function testFromObject__MustReturnProductWithName(): void
    {
        $response = GetProductResponse::fromObject($this->product);
        $this->assertEquals($this->product->name, $response->product->name);
    }

    public function testFromObject__MustReturnProductWithPrice(): void
    {
        $response = GetProductResponse::fromObject($this->product);
        $this->assertEquals($this->product->price, $response->product->price);
    }
}
