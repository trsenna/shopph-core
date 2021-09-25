<?php

namespace Shopph\Tests\Domain\Customer\Model;

use PHPUnit\Framework\TestCase;
use Shopph\Contract\Foundation\Model\IdentityInterface;
use Shopph\Domain\Customer\Model\Customer;
use Shopph\Domain\Customer\Model\CustomerName;

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
}
