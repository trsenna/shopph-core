<?php

namespace Shopph\Domain\Customer\Model;

use PHPUnit\Framework\TestCase;

final class CustomerNameTest extends TestCase
{
    public function testGetFullNameWhenHasNameMustReturnName()
    {
        $customerName = new CustomerName('Jon');
        $this->assertEquals('Jon', $customerName->getFullName());
    }
}
