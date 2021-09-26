<?php

namespace Shopph\Tests\Customer\Application\Event;

use PHPUnit\Framework\TestCase;
use Shopph\Customer\Domain\Model\Customer;
use Shopph\Customer\Domain\Model\CustomerName;
use Shopph\Foundation\Contract\Model\IdentityInterface;

use function Shopph\Tests\factory_identity;

final class StoredCustomerTest extends TestCase
{
    private ?IdentityInterface $identity;
    private ?CustomerName $customerName;

    public function setUp(): void
    {
        $this->identity = factory_identity('87ffd646-9ef8-473b-951c-28f53fe8cadc');
        $this->customerName = new CustomerName('Jon');
    }

    public function testFromObjectWhenCalledMustReturnTheEventInstance(): void
    {
        $customer = new Customer($this->identity, $this->customerName);

        $this->assertEquals('87ffd646-9ef8-473b-951c-28f53fe8cadc', $customer->getIdentity()->value());
        $this->assertEquals('Jon', $customer->getName()->getFullName());
    }
}
