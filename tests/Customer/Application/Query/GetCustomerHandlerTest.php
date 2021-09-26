<?php

namespace Shopph\Tests\Customer\Application\Command;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Shopph\Customer\Application\Query\GetCustomer;
use Shopph\Customer\Application\Query\GetCustomerHandler;
use Shopph\Customer\Application\Query\GetCustomerResponse;
use Shopph\Customer\Contract\Model\CustomerFinderInterface;

final class GetCustomerHandlerTest extends TestCase
{
    private ?GetCustomer $query;
    private ?GetCustomerHandler $queryHandler;
    private ?\stdClass $customer;

    private ?MockObject $customerFinder;

    public function setUp(): void
    {
        $this->customerFinder = $this->createMock(CustomerFinderInterface::class);

        $this->query = new GetCustomer();
        $this->query->id = '87ffd646-9ef8-473b-951c-28f53fe8cadc';

        $reflection = new \ReflectionClass(GetCustomerHandler::class);
        $this->queryHandler = $reflection->newInstance($this->customerFinder);

        $this->customer = new \stdClass;
        $this->customer->id = '87ffd646-9ef8-473b-951c-28f53fe8cadc';
        $this->customer->name = 'Jon';
    }

    public function testExecuteWhenCalledMustFindOne(): void
    {
        $this->customerFinder
            ->expects($this->once())->method('findOne')
            ->with('87ffd646-9ef8-473b-951c-28f53fe8cadc');

        $this->queryHandler->execute($this->query);
    }

    public function testExecuteWhenCalledMustReturnValidResponse(): void
    {
        $this->customerFinder
            ->method('findOne')
            ->willReturn($this->customer);

        $response = $this->queryHandler->execute($this->query);

        $this->assertNotNull($response);
        $this->assertNotNull($response->customer);
        $this->assertInstanceOf(GetCustomerResponse::class, $response);
    }
}
