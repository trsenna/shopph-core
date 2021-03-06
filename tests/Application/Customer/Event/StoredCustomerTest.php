<?php

namespace Shopph\Tests\Application\Customer\Event;

use PHPUnit\Framework\TestCase;
use Shopph\Application\Customer\Event\StoredCustomer;
use Shopph\Domain\Customer\Model\Customer;
use Shopph\Domain\Customer\Model\CustomerName;
use Shopph\Tests\Shared\Faker\IdentityFakerTrait;

final class StoredCustomerTest extends TestCase
{
    use IdentityFakerTrait;

    private ?Customer $customer;

    public function setUp(): void
    {
        $this->customer = new Customer(
            $this->fakeIdentity('87ffd646-9ef8-473b-951c-28f53fe8cadc'),
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
