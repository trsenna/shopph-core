<?php

namespace Shopph\Tests\Customer\Domain\Model;

use PHPUnit\Framework\TestCase;
use Shopph\Contract\Foundation\Domain\Model\IdentityInterface;
use Shopph\Customer\Domain\Model\Customer;
use Shopph\Customer\Domain\Model\CustomerName;

use function Shopph\Tests\factory_identity;

final class CustomerTest extends TestCase
{
    private ?IdentityInterface $identity = null;
    private ?CustomerName $customerName = null;

    public function setUp(): void
    {
        $this->identity = factory_identity('87ffd646-9ef8-473b-951c-28f53fe8cadc');
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
        } catch (\InvalidArgumentException $e) {
            $this->assertStringContainsString('name', $e->getMessage());
            $this->assertStringContainsString('not blank', $e->getMessage());
        }
    }
}
