<?php

namespace Shopph\Tests\Product\Domain\Model;

use PHPUnit\Framework\TestCase;
use Shopph\Product\Domain\Model\ProductPrice;
use Shopph\Shared\Verification\VerifyException;

final class ProductPriceTest extends TestCase
{
    public function testCreateWhenValueIsZeroMustThrowException(): void
    {
        try {
            new ProductPrice(0);
            $this->fail();
        } catch (VerifyException $e) {
            $this->assertStringContainsString('value greater than zero', $e->getMessage());
        }
    }

    public function testCreateWhenValueIsLessThanZeroMustThrowException(): void
    {
        try {
            new ProductPrice(-1);
            $this->fail();
        } catch (VerifyException $e) {
            $this->assertStringContainsString('value greater than zero', $e->getMessage());
        }
    }

    public function testGetValueWhenHasValueMustReturnValue()
    {
        $productPrice = new ProductPrice(10.7);
        $this->assertEquals(10.7, $productPrice->getValue());
    }

    public function testEqualsToWhenSameValueMustReturnTrue(): void
    {
        $productPrice = new ProductPrice(10.7);
        $productPriceOther = new ProductPrice(10.7);
        $this->assertTrue($productPrice->equalsTo($productPriceOther));
    }

    public function testEqualsToWhenNotSameValueMustReturnFalse(): void
    {
        $productPrice = new ProductPrice(10.7);
        $productPriceOther = new ProductPrice(10.9);
        $this->assertFalse($productPrice->equalsTo($productPriceOther));
    }
}
