<?php

namespace Shopph\Tests\Customer\Domain\Model;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Shopph\Contract\Foundation\Domain\Model\IdentityFactoryInterface;
use Shopph\Customer\Domain\Model\CustomerFactory;

use function Shopph\Tests\factory_identity;

final class CustomerFactoryTest extends TestCase
{
    private ?IdentityFactoryInterface $identityFactory = null;

    public function setUp(): void
    {
        /** @var MockObject $identityFactoryMock */
        $identityFactoryMock = $this->createMock(IdentityFactoryInterface::class);
        $identityFactoryMock->method('create')->willReturn(
            factory_identity('87ffd646-9ef8-473b-951c-28f53fe8cadc')
        );

        $this->identityFactory = $identityFactoryMock;
    }

    public function testCreateWhenCalledMustReturnCustomerWithIdentity()
    {
        $customerFactory = new CustomerFactory($this->identityFactory);

        $customer = $customerFactory->create('Jon');
        $customerIdentity = $customer->getIdentity();

        $this->assertNotNull($customer);
        $this->assertNotNull($customerIdentity);
        $this->assertEquals('87ffd646-9ef8-473b-951c-28f53fe8cadc', $customerIdentity->value());
    }

    public function testCreateWhenCalledMustReturnCustomerWithName()
    {
        $customerFactory = new CustomerFactory($this->identityFactory);

        $customer = $customerFactory->create('Jon');
        $customerName = $customer->getName();

        $this->assertNotNull($customer);
        $this->assertNotNull($customerName);
        $this->assertEquals('Jon', $customerName->getFullName());
    }
}
