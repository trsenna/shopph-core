<?php

namespace Shopph\Tests\Product\Domain\Model;

use PHPUnit\Framework\TestCase;
use Shopph\Contract\Shared\Model\IdentityInterface;
use Shopph\Product\Domain\Model\Product;
use Shopph\Product\Domain\Model\ProductPrice;
use Shopph\Shared\Verification\VerifyException;
use Shopph\Tests\Shared\Faker\IdentityFakerTrait;

final class ProductTest extends TestCase
{
    use IdentityFakerTrait;

    private ?IdentityInterface $identity = null;
    private ?ProductPrice $productPrice = null;

    public function setUp(): void
    {
        $this->identity = $this->fakeIdentity('87ffd646-9ef8-473b-951c-28f53fe8cadc');
        $this->productPrice = new ProductPrice(10.7);
    }

    public function testGetNameWhenHasNameMustReturnName()
    {
        $product = new Product($this->identity, 'Product #1', $this->productPrice);
        $this->assertEquals('Product #1', $product->getName());
    }

    public function testGetPriceWhenHasPriceMustReturnPrice()
    {
        $product = new Product($this->identity, 'Product #1', $this->productPrice);
        $this->assertSame($this->productPrice, $product->getPrice());
    }

    public function testCreateWhenNameIsBlankMustThrowException(): void
    {
        try {
            new Product($this->identity, '', $this->productPrice);
            $this->fail();
        } catch (VerifyException $e) {
            $this->assertStringContainsString('name', $e->getMessage());
            $this->assertStringContainsString('not blank', $e->getMessage());
        }
    }
}
