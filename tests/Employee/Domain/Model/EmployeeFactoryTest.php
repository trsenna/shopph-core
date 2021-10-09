<?php

namespace Shopph\Tests\Employee\Domain\Model;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Shopph\Contract\Shared\Model\IdentityFactoryInterface;
use Shopph\Employee\Domain\Model\EmployeeFactory;
use Shopph\Tests\Shared\Faker\IdentityFakerTrait;

final class EmployeeFactoryTest extends TestCase
{
    use IdentityFakerTrait;

    private ?IdentityFactoryInterface $identityFactory = null;

    public function setUp(): void
    {
        /** @var MockObject $identityFactoryMock */
        $identityFactoryMock = $this->createMock(IdentityFactoryInterface::class);
        $identityFactoryMock->method('create')->willReturn(
            $this->fakeIdentity('87ffd646-9ef8-473b-951c-28f53fe8cadc')
        );

        $this->identityFactory = $identityFactoryMock;
    }

    public function testCreateWhenCalledMustReturnEmployeeWithIdentity()
    {
        $employeeFactory = new EmployeeFactory($this->identityFactory);

        $employee = $employeeFactory->create('Jon');
        $employeeIdentity = $employee->getIdentity();

        $this->assertNotNull($employee);
        $this->assertNotNull($employeeIdentity);
        $this->assertEquals('87ffd646-9ef8-473b-951c-28f53fe8cadc', $employeeIdentity->value());
    }

    public function testCreateWhenCalledMustReturnEmployeeWithName()
    {
        $employeeFactory = new EmployeeFactory($this->identityFactory);

        $employee = $employeeFactory->create('Jon');
        $employeeName = $employee->getName();

        $this->assertNotNull($employee);
        $this->assertNotNull($employeeName);
        $this->assertEquals('Jon', $employeeName->getFullName());
    }
}
