<?php

namespace Shopph\Tests\Employee\Domain\Model;

use PHPUnit\Framework\TestCase;
use Shopph\Employee\Domain\Model\EmployeeName;
use Shopph\Shared\Verification\VerifyException;

final class EmployeeNameTest extends TestCase
{
    public function testCreateWhenNameIsBlankMustThrowException(): void
    {
        try {
            new EmployeeName(' ');
            $this->fail();
        } catch (VerifyException $e) {
            $this->assertStringContainsString('name not blank', $e->getMessage());
        }
    }

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
