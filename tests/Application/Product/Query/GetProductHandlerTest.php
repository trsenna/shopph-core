<?php

namespace Shopph\Tests\Application\Product\Query;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Shopph\Application\Product\Query\GetProduct;
use Shopph\Application\Product\Query\GetProductHandler;
use Shopph\Application\Product\Query\GetProductResponse;
use Shopph\Domain\Contract\Model\ProductFinderInterface;

final class GetProductHandlerTest extends TestCase
{
    private ?\stdClass $product;
    private ?MockObject $productFinderMock;

    private ?GetProduct $query;
    private ?GetProductHandler $queryHandler;

    public function setUp(): void
    {
        $this->product = new \stdClass;
        $this->product->id = '87ffd646-9ef8-473b-951c-28f53fe8cadc';
        $this->product->name = 'Jon';
        $this->product->price = 7.6;

        $this->productFinderMock = $this->createMock(ProductFinderInterface::class);

        $this->query = new GetProduct();
        $this->query->id = '87ffd646-9ef8-473b-951c-28f53fe8cadc';

        $reflection = new \ReflectionClass(GetProductHandler::class);
        $this->queryHandler = $reflection->newInstance($this->productFinderMock);
    }

    public function testExecute__MustFindOne(): void
    {
        $this->productFinderMock
            ->expects($this->once())->method('findOne')
            ->with('87ffd646-9ef8-473b-951c-28f53fe8cadc');

        $this->queryHandler->execute($this->query);
    }

    public function testExecute__MustReturnResponse(): void
    {
        $this->productFinderMock
            ->method('findOne')
            ->willReturn($this->product);

        $response = $this->queryHandler->execute($this->query);

        $this->assertNotNull($response);
        $this->assertInstanceOf(GetProductResponse::class, $response);
    }

    public function testExecute__MustReturnResponseWithProduct(): void
    {
        $this->productFinderMock
            ->method('findOne')
            ->willReturn($this->product);

        $response = $this->queryHandler->execute($this->query);

        $this->assertNotNull($response->product);
        $this->assertSame($this->product, $response->product);
    }
}
