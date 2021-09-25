<?php

namespace Shopph\Tests\Domain\Customer\Model;

use PHPUnit\Framework\TestCase;
use Shopph\Domain\Customer\Model\CustomerName;

final class CustomerNameTest extends TestCase
{
    public function testGetFullNameWhenHasNameMustReturnName()
    {
        $customerName = new CustomerName('Jon');
        $this->assertEquals('Jon', $customerName->getFullName());
    }
}
