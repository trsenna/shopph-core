<?php

namespace Shopph\Tests\Application\Sale\Query;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Shopph\Application\Sale\Query\GetSales;
use Shopph\Application\Sale\Query\GetSalesHandler;
use Shopph\Application\Sale\Query\GetSalesResponse;
use Shopph\Domain\Contract\Model\SaleFinderInterface;

final class GetSalesHandlerTest extends TestCase
{
    private ?array $sales;
    private ?MockObject $saleFinderMock;

    private ?GetSales $query;
    private ?GetSalesHandler $queryHandler;

    public function setUp(): void
    {
        $product = new \stdClass;
        $product->id = '32218f4d-434f-4249-9ac6-725d555f2ce2';
        $product->name = 'product #1';
        $product->price = 7.6;

        $employee = new \stdClass;
        $employee->id = '6c5ab5a2-5025-4894-8e97-a1458f5b2e15';
        $employee->name = 'employee #1';

        $customer = new \stdClass;
        $customer->id = '6f0885c0-58f2-4a5f-b9bc-2df3549cfe03';
        $customer->name = 'customer #1';

        $this->sales[0] = new \stdClass;
        $this->sales[0]->id = '87ffd646-9ef8-473b-951c-28f53fe8cadc';
        $this->sales[0]->product = $product;
        $this->sales[0]->employee = $employee;
        $this->sales[0]->customer = $customer;
        $this->sales[0]->price = 7.6;
        $this->sales[0]->date = new \DateTime();

        $this->saleFinderMock = $this->createMock(SaleFinderInterface::class);

        $this->query = new GetSales();

        $reflection = new \ReflectionClass(GetSalesHandler::class);
        $this->queryHandler = $reflection->newInstance($this->saleFinderMock);
    }

    public function testExecute__MustFindAll(): void
    {
        $this->saleFinderMock
            ->expects($this->once())->method('findAll');

        $this->queryHandler->execute($this->query);
    }

    public function testExecute__MustReturnResponse(): void
    {
        $this->saleFinderMock
            ->method('findAll')
            ->willReturn($this->sales);

        $response = $this->queryHandler->execute($this->query);

        $this->assertNotNull($response);
        $this->assertInstanceOf(GetSalesResponse::class, $response);
    }

    public function testExecute__MustReturnResponseWithSales(): void
    {
        $this->saleFinderMock
            ->method('findAll')
            ->willReturn($this->sales);

        $response = $this->queryHandler->execute($this->query);

        $this->assertNotEmpty($response->sales);
        $this->assertSame($this->sales, $response->sales);
    }
}
