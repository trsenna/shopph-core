<?php

namespace Shopph\Tests\Domain\Sale\Model;

use PHPUnit\Framework\TestCase;
use Shopph\Domain\Sale\Model\SalePrice;
use Shopph\Shared\Verification\VerifyException;

final class SalePriceTest extends TestCase
{
    public function testCreateWhenUnitPriceIsZeroMustThrowException(): void
    {
        try {
            new SalePrice(0);
            $this->fail();
        } catch (VerifyException $e) {
            $this->assertStringContainsString('unitPrice greater than zero', $e->getMessage());
        }
    }

    public function testCreateWhenUnitPriceIsLessThanZeroMustThrowException(): void
    {
        try {
            new SalePrice(-1);
            $this->fail();
        } catch (VerifyException $e) {
            $this->assertStringContainsString('unitPrice greater than zero', $e->getMessage());
        }
    }

    public function testCreateWhenQuantityIsZeroMustThrowException(): void
    {
        try {
            new SalePrice(4, 0);
            $this->fail();
        } catch (VerifyException $e) {
            $this->assertStringContainsString('quantity greater than zero', $e->getMessage());
        }
    }

    public function testCreateWhenQuantityIsLessThanZeroMustThrowException(): void
    {
        try {
            new SalePrice(4, -1);
            $this->fail();
        } catch (VerifyException $e) {
            $this->assertStringContainsString('quantity greater than zero', $e->getMessage());
        }
    }

    public function testGetValueWhenHasValueMustReturnValue()
    {
        $salePrice = new SalePrice(4, 2);
        $this->assertEquals(8, $salePrice->getValue());
    }

    public function testEqualsToWhenSameValueMustReturnTrue(): void
    {
        $salePrice = new SalePrice(4, 2);
        $salePriceOther = new SalePrice(4, 2);
        $this->assertTrue($salePrice->equalsTo($salePriceOther));
    }

    public function testEqualsToWhenNotSameValueMustReturnFalse(): void
    {
        $salePrice = new SalePrice(4, 2);
        $salePriceOther = new SalePrice(4, 3);
        $this->assertFalse($salePrice->equalsTo($salePriceOther));
    }
}
