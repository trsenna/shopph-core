<?php

namespace Shopph\Tests\Application\Product\Event;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Shopph\Application\Product\Event\StoredProduct;
use Shopph\Domain\Product\Model\Product;
use Shopph\Domain\Product\Model\ProductPrice;
use Shopph\Shared\Contract\Model\IdentityInterface;

final class StoredProductTest extends TestCase
{
    private ?String $uuid4Value;
    private ?MockObject $productIdentityMock;
    private ?String $productName;
    private ?ProductPrice $productPrice;
    private ?Product $product;

    public function setUp(): void
    {
        $this->uuid4Value = '87ffd646-9ef8-473b-951c-28f53fe8cadc';
        $this->productIdentityMock = $this->createMock(IdentityInterface::class);
        $this->productName = 'Product #1';
        $this->productPrice = new ProductPrice(7.4);

        $productClazz = new \ReflectionClass(Product::class);
        $this->product = $productClazz->newInstance(
            $this->productIdentityMock,
            $this->productName,
            $this->productPrice,
        );
    }

    public function testFromEntity__MustHaveId(): void
    {
        $this->productIdentityMock->method('value')->willReturn($this->uuid4Value);

        $event = StoredProduct::fromEntity($this->product);
        $this->assertEquals($this->uuid4Value, $event->id);
    }

    public function testFromEntity__MustHaveName(): void
    {
        $event = StoredProduct::fromEntity($this->product);
        $this->assertEquals($this->productName, $event->name);
    }

    public function testFromEntity__MustHavePrice(): void
    {
        $event = StoredProduct::fromEntity($this->product);
        $this->assertEquals($this->productPrice->getValue(), $event->price);
    }
}
