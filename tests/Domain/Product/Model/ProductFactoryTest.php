<?php

namespace Shopph\Tests\Domain\Product\Model;

use PHPUnit\Framework\TestCase;
use Shopph\Domain\Contract\Model\ProductFactoryInterface;
use Shopph\Domain\Product\Model\Product;
use Shopph\Domain\Product\Model\ProductFactory;
use Shopph\Shared\Contract\Model\IdentityFactoryInterface;
use Shopph\Tests\Shared\Faker\IdentityFakerTrait;

final class ProductFactoryTest extends TestCase
{
    use IdentityFakerTrait;

    private ?IdentityFactoryInterface $identityFactory;
    private ?ProductFactoryInterface $productFactory;

    public function setUp(): void
    {
        /** @var MockObject $identityFactoryMock */
        $identityFactoryMock = $this->createMock(IdentityFactoryInterface::class);
        $identityFactoryMock->method('create')->willReturn(
            $this->fakeIdentity('87ffd646-9ef8-473b-951c-28f53fe8cadc')
        );

        $this->identityFactory = $identityFactoryMock;
        $this->productFactory = new ProductFactory($this->identityFactory);
    }

    public function testCreateWhenCalledMustReturnProduct()
    {
        $product = $this->productFactory->create('Product #1', 10.7);
        $this->assertNotNull($product);
        $this->assertInstanceOf(Product::class, $product);
    }

    public function testCreateWhenCalledMustReturnProductWithIdentity()
    {
        $product = $this->productFactory->create('Product #1', 10.7);
        $productIdentity = $product->getIdentity();

        $this->assertNotNull($product->getIdentity());
        $this->assertEquals('87ffd646-9ef8-473b-951c-28f53fe8cadc', $productIdentity->value());
    }

    public function testCreateWhenCalledMustReturnProductWithName()
    {
        $product = $this->productFactory->create('Product #1', 10.7);
        $productName = $product->getName();

        $this->assertNotNull($productName);
        $this->assertEquals('Product #1', $productName);
    }

    public function testCreateWhenCalledMustReturnProductWithPrice()
    {
        $product = $this->productFactory->create('Product #1', 10.7);
        $productPrice = $product->getPrice();

        $this->assertNotNull($productPrice);
        $this->assertEquals(10.7, $productPrice->getValue());
    }
}
