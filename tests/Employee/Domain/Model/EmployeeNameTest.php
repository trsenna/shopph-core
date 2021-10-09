<?php

namespace Shopph\Tests\Employee\Domain\Model;

use PHPUnit\Framework\TestCase;
use Shopph\Employee\Domain\Model\EmployeeName;

final class EmployeeNameTest extends TestCase
{
    public function testGetFullNameWhenHasNameMustReturnName()
    {
        $employeeName = new EmployeeName('Jon');
        $this->assertEquals('Jon', $employeeName->getFullName());
    }

    public function testEqualsToWhenSameNameMustReturnTrue(): void
    {
        $employeeName = new EmployeeName('Jon');
        $employeeNameOther = new EmployeeName('Jon');
        $this->assertTrue($employeeName->equalsTo($employeeNameOther));
    }

    public function testEqualsToWhenNotSameNameMustReturnFalse(): void
    {
        $employeeName = new EmployeeName('Jon');
        $employeeNameOther = new EmployeeName('Alice');
        $this->assertFalse($employeeName->equalsTo($employeeNameOther));
    }
}
