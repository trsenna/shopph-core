<?php

namespace Shopph\Tests\Application\Sale\Query;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Shopph\Application\Sale\Query\GetSale;
use Shopph\Application\Sale\Query\GetSaleHandler;
use Shopph\Application\Sale\Query\GetSaleResponse;
use Shopph\Domain\Contract\Model\SaleFinderInterface;

final class GetSaleHandlerTest extends TestCase
{
    private ?\stdClass $sale;
    private ?MockObject $saleFinderMock;

    private ?GetSale $query;
    private ?GetSaleHandler $queryHandler;

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

        $this->sale = new \stdClass;
        $this->sale->id = '87ffd646-9ef8-473b-951c-28f53fe8cadc';
        $this->sale->product = $product;
        $this->sale->employee = $employee;
        $this->sale->customer = $customer;
        $this->sale->price = 7.6;
        $this->sale->date = new \DateTime();

        $this->saleFinderMock = $this->createMock(SaleFinderInterface::class);

        $this->query = new GetSale();
        $this->query->id = '87ffd646-9ef8-473b-951c-28f53fe8cadc';

        $reflection = new \ReflectionClass(GetSaleHandler::class);
        $this->queryHandler = $reflection->newInstance($this->saleFinderMock);
    }

    public function testExecute__MustFindOne(): void
    {
        $this->saleFinderMock
            ->expects($this->once())->method('findOne')
            ->with('87ffd646-9ef8-473b-951c-28f53fe8cadc');

        $this->queryHandler->execute($this->query);
    }

    public function testExecute__MustReturnResponse(): void
    {
        $this->saleFinderMock
            ->method('findOne')
            ->willReturn($this->sale);

        $response = $this->queryHandler->execute($this->query);

        $this->assertNotNull($response);
        $this->assertInstanceOf(GetSaleResponse::class, $response);
    }

    public function testExecute__MustReturnResponseWithSale(): void
    {
        $this->saleFinderMock
            ->method('findOne')
            ->willReturn($this->sale);

        $response = $this->queryHandler->execute($this->query);

        $this->assertNotNull($response->sale);
        $this->assertSame($this->sale, $response->sale);
    }
}
