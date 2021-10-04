<?php

namespace Shopph\Tests\Customer\Domain\Model;

use PHPUnit\Framework\TestCase;
use Shopph\Contract\Foundation\Model\IdentityInterface;
use Shopph\Customer\Domain\Model\Customer;
use Shopph\Customer\Domain\Model\CustomerName;
use Shopph\Shared\Verification\VerifyException;
use Shopph\Tests\Shared\Helper\IdentityFakeTrait;

final class CustomerTest extends TestCase
{
    use IdentityFakeTrait;

    private ?IdentityInterface $identity = null;
    private ?CustomerName $customerName = null;

    public function setUp(): void
    {
        $this->identity = $this->fakeIdentity('87ffd646-9ef8-473b-951c-28f53fe8cadc');
        $this->customerName = new CustomerName('Jon');
    }

    public function testGetNameWhenHasNameMustReturnName()
    {
        $customer = new Customer($this->identity, $this->customerName);
        $this->assertSame($this->customerName, $customer->getName());
    }

    public function testCreateWhenNameIsBlankMustThrowException(): void
    {
        try {
            new CustomerName(' ');
            $this->fail();
        } catch (VerifyException $e) {
            $this->assertStringContainsString('name', $e->getMessage());
            $this->assertStringContainsString('not blank', $e->getMessage());
        }
    }
}
