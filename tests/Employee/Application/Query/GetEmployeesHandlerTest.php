<?php

namespace Shopph\Tests\Employee\Application\Command;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Shopph\Domain\Contract\Model\EmployeeFinderInterface;
use Shopph\Employee\Application\Query\GetEmployees;
use Shopph\Employee\Application\Query\GetEmployeesHandler;
use Shopph\Employee\Application\Query\GetEmployeesResponse;

final class GetEmployeesHandlerTest extends TestCase
{
    private ?GetEmployees $query;
    private ?GetEmployeesHandler $queryHandler;
    private ?array $employees;

    private ?MockObject $employeeFinder;

    public function setUp(): void
    {
        $this->employeeFinder = $this->createMock(EmployeeFinderInterface::class);

        $this->query = new GetEmployees();

        $reflection = new \ReflectionClass(GetEmployeesHandler::class);
        $this->queryHandler = $reflection->newInstance($this->employeeFinder);

        $this->employees = [];
        $this->employees[0] = new \stdClass;
        $this->employees[0]->id = '87ffd646-9ef8-473b-951c-28f53fe8cadc';
        $this->employees[0]->name = 'Jon';
    }

    public function testExecuteWhenCalledMustFindAll(): void
    {
        $this->employeeFinder
            ->expects($this->once())->method('findAll');

        $this->queryHandler->execute($this->query);
    }

    public function testExecuteWhenCalledMustReturnValidResponse(): void
    {
        $this->employeeFinder
            ->method('findAll')
            ->willReturn($this->employees);

        $response = $this->queryHandler->execute($this->query);

        $this->assertNotNull($response);
        $this->assertNotEmpty($response->employees);
        $this->assertInstanceOf(GetEmployeesResponse::class, $response);
        $this->assertSame($this->employees, $response->employees);
    }
}
