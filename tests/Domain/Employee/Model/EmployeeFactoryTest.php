<?php

namespace Shopph\Tests\Domain\Employee\Model;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Shopph\Domain\Contract\Model\EmployeeFactoryInterface;
use Shopph\Domain\Employee\Model\Employee;
use Shopph\Domain\Employee\Model\EmployeeFactory;
use Shopph\Shared\Contract\Model\IdentityFactoryInterface;
use Shopph\Tests\Shared\Faker\IdentityFakerTrait;

final class EmployeeFactoryTest extends TestCase
{
    use IdentityFakerTrait;

    private ?IdentityFactoryInterface $identityFactory;
    private ?EmployeeFactoryInterface $employeeFactory;

    public function setUp(): void
    {
        /** @var MockObject $identityFactoryMock */
        $identityFactoryMock = $this->createMock(IdentityFactoryInterface::class);
        $identityFactoryMock->method('create')->willReturn(
            $this->fakeIdentity('87ffd646-9ef8-473b-951c-28f53fe8cadc')
        );

        $this->identityFactory = $identityFactoryMock;
        $this->employeeFactory = new EmployeeFactory($this->identityFactory);
    }

    public function testCreateWhenCalledMustReturnEmployee()
    {
        $employee = $this->employeeFactory->create('Jon');
        $employeeIdentity = $employee->getIdentity();

        $this->assertNotNull($employee);
        $this->assertInstanceOf(Employee::class, $employee);
    }

    public function testCreateWhenCalledMustReturnEmployeeWithIdentity()
    {
        $employee = $this->employeeFactory->create('Jon');
        $employeeIdentity = $employee->getIdentity();

        $this->assertNotNull($employeeIdentity);
        $this->assertEquals('87ffd646-9ef8-473b-951c-28f53fe8cadc', $employeeIdentity->value());
    }

    public function testCreateWhenCalledMustReturnEmployeeWithName()
    {
        $employee = $this->employeeFactory->create('Jon');
        $employeeName = $employee->getName();

        $this->assertNotNull($employeeName);
        $this->assertEquals('Jon', $employeeName->getFullName());
    }
}
