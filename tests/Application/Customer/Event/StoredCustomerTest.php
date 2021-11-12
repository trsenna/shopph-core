<?php

namespace Shopph\Tests\Application\Customer\Event;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Shopph\Application\Customer\Event\StoredCustomer;
use Shopph\Domain\Customer\Model\Customer;
use Shopph\Domain\Customer\Model\CustomerName;
use Shopph\Shared\Contract\Model\IdentityInterface;

final class StoredCustomerTest extends TestCase
{
    private ?String $uuid4Value;
    private ?MockObject $customerIdentity;
    private ?CustomerName $customerName;
    private ?Customer $customer;

    public function setUp(): void
    {
        $this->uuid4Value = '87ffd646-9ef8-473b-951c-28f53fe8cadc';
        $this->customerIdentity = $this->createMock(IdentityInterface::class);
        $this->customerName = new CustomerName('Customer #1');

        $customerClazz = new \ReflectionClass(Customer::class);
        $this->customer = $customerClazz->newInstance(
            $this->customerIdentity,
            $this->customerName,
        );
    }

    public function testFromEntity__MustHaveId(): void
    {
        $this->customerIdentity->method('value')->willReturn($this->uuid4Value);

        $event = StoredCustomer::fromEntity($this->customer);
        $this->assertEquals($this->uuid4Value, $event->id);
    }

    public function testFromEntity__MustHaveName(): void
    {
        $event = StoredCustomer::fromEntity($this->customer);
        $this->assertEquals($this->customerName->getFullName(), $event->name);
    }
}
