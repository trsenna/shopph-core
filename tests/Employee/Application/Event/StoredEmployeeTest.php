<?php

namespace Shopph\Tests\Employee\Application\Event;

use PHPUnit\Framework\TestCase;
use Shopph\Employee\Application\Event\StoredEmployee;
use Shopph\Employee\Domain\Model\Employee;
use Shopph\Employee\Domain\Model\EmployeeName;
use Shopph\Tests\Shared\Faker\IdentityFakerTrait;

final class StoredEmployeeTest extends TestCase
{
    use IdentityFakerTrait;

    private ?Employee $employee;

    public function setUp(): void
    {
        $this->employee = new Employee(
            $this->fakeIdentity('87ffd646-9ef8-473b-951c-28f53fe8cadc'),
            new EmployeeName('Jon')
        );
    }

    public function testFromEntityWhenCalledMustReturnValidInstance(): void
    {
        $event = StoredEmployee::fromEntity($this->employee);
        $this->assertEquals('87ffd646-9ef8-473b-951c-28f53fe8cadc', $event->id);
        $this->assertEquals('Jon', $event->name);
    }
}
