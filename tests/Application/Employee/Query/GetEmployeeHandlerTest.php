<?php

namespace Shopph\Tests\Application\Employee\Query;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Shopph\Application\Employee\Query\GetEmployee;
use Shopph\Application\Employee\Query\GetEmployeeHandler;
use Shopph\Application\Employee\Query\GetEmployeeResponse;
use Shopph\Domain\Contract\Model\EmployeeFinderInterface;

final class GetEmployeeHandlerTest extends TestCase
{
    private ?GetEmployee $query;
    private ?GetEmployeeHandler $queryHandler;
    private ?\stdClass $employee;

    private ?MockObject $employeeFinder;

    public function setUp(): void
    {
        $this->employeeFinder = $this->createMock(EmployeeFinderInterface::class);

        $this->query = new GetEmployee();
        $this->query->id = '87ffd646-9ef8-473b-951c-28f53fe8cadc';

        $reflection = new \ReflectionClass(GetEmployeeHandler::class);
        $this->queryHandler = $reflection->newInstance($this->employeeFinder);

        $this->employee = new \stdClass;
        $this->employee->id = '87ffd646-9ef8-473b-951c-28f53fe8cadc';
        $this->employee->name = 'Jon';
    }

    public function testExecuteWhenCalledMustFindOne(): void
    {
        $this->employeeFinder
            ->expects($this->once())->method('findOne')
            ->with('87ffd646-9ef8-473b-951c-28f53fe8cadc');

        $this->queryHandler->execute($this->query);
    }

    public function testExecuteWhenCalledMustReturnValidResponse(): void
    {
        $this->employeeFinder
            ->method('findOne')
            ->willReturn($this->employee);

        $response = $this->queryHandler->execute($this->query);

        $this->assertNotNull($response);
        $this->assertNotNull($response->employee);
        $this->assertInstanceOf(GetEmployeeResponse::class, $response);
        $this->assertSame($this->employee, $response->employee);
    }
}
