<?php

namespace Shopph\Tests\Customer\Application\Command;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Shopph\Contract\Customer\Domain\Model\CustomerFinderInterface;
use Shopph\Customer\Application\Query\GetCustomers;
use Shopph\Customer\Application\Query\GetCustomersHandler;
use Shopph\Customer\Application\Query\GetCustomersResponse;

final class GetCustomersHandlerTest extends TestCase
{
    private ?GetCustomers $query;
    private ?GetCustomersHandler $queryHandler;
    private ?array $customers;

    private ?MockObject $customerFinder;

    public function setUp(): void
    {
        $this->customerFinder = $this->createMock(CustomerFinderInterface::class);

        $this->query = new GetCustomers();

        $reflection = new \ReflectionClass(GetCustomersHandler::class);
        $this->queryHandler = $reflection->newInstance($this->customerFinder);

        $this->customers = [];
        $this->customers[0] = new \stdClass;
        $this->customers[0]->id = '87ffd646-9ef8-473b-951c-28f53fe8cadc';
        $this->customers[0]->name = 'Jon';
    }

    public function testExecuteWhenCalledMustFindAll(): void
    {
        $this->customerFinder
            ->expects($this->once())->method('findAll');

        $this->queryHandler->execute($this->query);
    }

    public function testExecuteWhenCalledMustReturnValidResponse(): void
    {
        $this->customerFinder
            ->method('findAll')
            ->willReturn($this->customers);

        $response = $this->queryHandler->execute($this->query);

        $this->assertNotNull($response);
        $this->assertNotEmpty($response->customers);
        $this->assertInstanceOf(GetCustomersResponse::class, $response);
        $this->assertSame($this->customers, $response->customers);
    }
}
