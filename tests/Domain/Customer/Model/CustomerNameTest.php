<?php

namespace Shopph\Tests\Domain\Customer\Model;

use PHPUnit\Framework\TestCase;
use Shopph\Domain\Customer\Model\CustomerName;
use Shopph\Shared\Verification\VerifyException;

final class CustomerNameTest extends TestCase
{
    public function testCreateWhenNameIsBlankMustThrowException(): void
    {
        try {
            new CustomerName(' ');
            $this->fail();
        } catch (VerifyException $e) {
            $this->assertStringContainsString('name not blank', $e->getMessage());
        }
    }

    public function testGetFullNameWhenHasNameMustReturnName()
    {
        $customerName = new CustomerName('Jon');
        $this->assertEquals('Jon', $customerName->getFullName());
    }

    public function testEqualsToWhenSameNameMustReturnTrue(): void
    {
        $customerName = new CustomerName('Jon');
        $customerNameOther = new CustomerName('Jon');
        $this->assertTrue($customerName->equalsTo($customerNameOther));
    }

    public function testEqualsToWhenNotSameNameMustReturnFalse(): void
    {
        $customerName = new CustomerName('Jon');
        $customerNameOther = new CustomerName('Alice');
        $this->assertFalse($customerName->equalsTo($customerNameOther));
    }
}
