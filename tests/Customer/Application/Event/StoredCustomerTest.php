<?php

namespace Shopph\Tests\Customer\Application\Event;

use PHPUnit\Framework\TestCase;
use Shopph\Customer\Application\Event\StoredCustomer;
use Shopph\Customer\Domain\Model\Customer;
use Shopph\Customer\Domain\Model\CustomerName;

use function Shopph\Tests\factory_identity;

final class StoredCustomerTest extends TestCase
{
    private ?Customer $customer;

    public function setUp(): void
    {
        $this->customer = new Customer(
            factory_identity('87ffd646-9ef8-473b-951c-28f53fe8cadc'),
            new CustomerName('Jon')
        );
    }

    public function testFromEntityWhenCalledMustReturnValidInstance(): void
    {
        $event = StoredCustomer::fromEntity($this->customer);
        $this->assertEquals('87ffd646-9ef8-473b-951c-28f53fe8cadc', $event->id);
        $this->assertEquals('Jon', $event->name);
    }
}
