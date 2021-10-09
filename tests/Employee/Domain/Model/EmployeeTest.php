<?php

namespace Shopph\Tests\Employee\Domain\Model;

use PHPUnit\Framework\TestCase;
use Shopph\Contract\Shared\Model\IdentityInterface;
use Shopph\Employee\Domain\Model\Employee;
use Shopph\Employee\Domain\Model\EmployeeName;
use Shopph\Shared\Verification\VerifyException;
use Shopph\Tests\Shared\Faker\IdentityFakerTrait;

final class EmployeeTest extends TestCase
{
    use IdentityFakerTrait;

    private ?IdentityInterface $identity = null;
    private ?EmployeeName $employeeName = null;

    public function setUp(): void
    {
        $this->identity = $this->fakeIdentity('87ffd646-9ef8-473b-951c-28f53fe8cadc');
        $this->employeeName = new EmployeeName('Jon');
    }

    public function testGetNameWhenHasNameMustReturnName()
    {
        $employee = new Employee($this->identity, $this->employeeName);
        $this->assertSame($this->employeeName, $employee->getName());
    }

    public function testCreateWhenNameIsBlankMustThrowException(): void
    {
        try {
            new EmployeeName(' ');
            $this->fail();
        } catch (VerifyException $e) {
            $this->assertStringContainsString('name', $e->getMessage());
            $this->assertStringContainsString('not blank', $e->getMessage());
        }
    }
}
