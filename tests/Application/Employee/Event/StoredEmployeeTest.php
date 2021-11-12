<?php

namespace Shopph\Tests\Application\Employee\Event;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Shopph\Application\Employee\Event\StoredEmployee;
use Shopph\Domain\Employee\Model\Employee;
use Shopph\Domain\Employee\Model\EmployeeName;
use Shopph\Shared\Contract\Model\IdentityInterface;

final class StoredEmployeeTest extends TestCase
{
    private ?String $uuid4Value;
    private ?MockObject $employeeIdentity;
    private ?EmployeeName $employeeName;
    private ?Employee $employee;

    public function setUp(): void
    {
        $this->uuid4Value = '87ffd646-9ef8-473b-951c-28f53fe8cadc';
        $this->employeeIdentity = $this->createMock(IdentityInterface::class);
        $this->employeeName = new EmployeeName('Employee #1');

        $employeeClazz = new \ReflectionClass(Employee::class);
        $this->employee = $employeeClazz->newInstance(
            $this->employeeIdentity,
            $this->employeeName
        );
    }

    public function testFromEntity__MustHaveId(): void
    {
        $this->employeeIdentity->method('value')->willReturn($this->uuid4Value);

        $event = StoredEmployee::fromEntity($this->employee);
        $this->assertEquals($this->uuid4Value, $event->id);
    }

    public function testFromEntity__MustHaveName(): void
    {
        $event = StoredEmployee::fromEntity($this->employee);
        $this->assertEquals($this->employeeName->getFullName(), $event->name);
    }
}
