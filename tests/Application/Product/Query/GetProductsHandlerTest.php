<?php

namespace Shopph\Tests\Application\Product\Query;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Shopph\Application\Product\Query\GetProducts;
use Shopph\Application\Product\Query\GetProductsHandler;
use Shopph\Application\Product\Query\GetProductsResponse;
use Shopph\Domain\Contract\Model\ProductFinderInterface;

final class GetProductsHandlerTest extends TestCase
{
    private ?array $products;
    private ?MockObject $productFinderMock;

    private ?GetProducts $query;
    private ?GetProductsHandler $queryHandler;

    public function setUp(): void
    {
        $this->products = [];
        $this->products[0] = new \stdClass;
        $this->products[0]->id = '87ffd646-9ef8-473b-951c-28f53fe8cadc';
        $this->products[0]->name = 'Jon';

        $this->productFinderMock = $this->createMock(ProductFinderInterface::class);

        $this->query = new GetProducts();

        $reflection = new \ReflectionClass(GetProductsHandler::class);
        $this->queryHandler = $reflection->newInstance($this->productFinderMock);
    }

    public function testExecute__MustFindAll(): void
    {
        $this->productFinderMock
            ->expects($this->once())->method('findAll');

        $this->queryHandler->execute($this->query);
    }

    public function testExecute__MustReturnResponse(): void
    {
        $this->productFinderMock
            ->method('findAll')
            ->willReturn($this->products);

        $response = $this->queryHandler->execute($this->query);

        $this->assertNotNull($response);
        $this->assertInstanceOf(GetProductsResponse::class, $response);
    }

    public function testExecute__MustReturnResponseWithProducts(): void
    {
        $this->productFinderMock
            ->method('findAll')
            ->willReturn($this->products);

        $response = $this->queryHandler->execute($this->query);

        $this->assertNotEmpty($response->products);
        $this->assertSame($this->products, $response->products);
    }
}
