<?php

namespace Shopph\Tests\Domain\Customer\Model;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Shopph\Contract\Shared\Model\IdentityFactoryInterface;
use Shopph\Domain\Contract\Model\CustomerFactoryInterface;
use Shopph\Domain\Customer\Model\Customer;
use Shopph\Domain\Customer\Model\CustomerFactory;
use Shopph\Tests\Shared\Faker\IdentityFakerTrait;

final class CustomerFactoryTest extends TestCase
{
    use IdentityFakerTrait;

    private ?IdentityFactoryInterface $identityFactory;
    private ?CustomerFactoryInterface $customerFactory;

    public function setUp(): void
    {
        /** @var MockObject $identityFactoryMock */
        $identityFactoryMock = $this->createMock(IdentityFactoryInterface::class);
        $identityFactoryMock->method('create')->willReturn(
            $this->fakeIdentity('87ffd646-9ef8-473b-951c-28f53fe8cadc')
        );

        $this->identityFactory = $identityFactoryMock;
        $this->customerFactory = new CustomerFactory($this->identityFactory);
    }

    public function testCreateWhenCalledMustReturnCustomer()
    {
        $customer = $this->customerFactory->create('Jon');
        $this->assertNotNull($customer);
        $this->assertInstanceOf(Customer::class, $customer);
    }

    public function testCreateWhenCalledMustReturnCustomerWithIdentity()
    {
        $customer = $this->customerFactory->create('Jon');
        $customerIdentity = $customer->getIdentity();

        $this->assertNotNull($customerIdentity);
        $this->assertEquals('87ffd646-9ef8-473b-951c-28f53fe8cadc', $customerIdentity->value());
    }

    public function testCreateWhenCalledMustReturnCustomerWithName()
    {
        $customer = $this->customerFactory->create('Jon');
        $customerName = $customer->getName();

        $this->assertNotNull($customerName);
        $this->assertEquals('Jon', $customerName->getFullName());
    }
}
