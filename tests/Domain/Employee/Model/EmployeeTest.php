<?php

namespace Shopph\Tests\Domain\Employee\Model;

use PHPUnit\Framework\TestCase;
use Shopph\Domain\Employee\Model\Employee;
use Shopph\Domain\Employee\Model\EmployeeName;
use Shopph\Shared\Contract\Model\IdentityInterface;
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
}
