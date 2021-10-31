<?php

namespace Shopph\Tests\Application\Product\Command;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Shopph\Application\Contract\Command\StoreProductHandlerInterface;
use Shopph\Application\Product\Command\StoreProduct;
use Shopph\Application\Product\Command\StoreProductHandler;
use Shopph\Domain\Contract\Model\ProductFactoryInterface;
use Shopph\Domain\Contract\Model\ProductRepositoryInterface;
use Shopph\Domain\Product\Model\Product;
use Shopph\Shared\Contract\Event\DispatcherInterface;

final class StoreProductHandlerTest extends TestCase
{
    private ?MockObject $productFactoryMock;
    private ?MockObject $productRepositoryMock;
    private ?MockObject $dispatcherMock;

    private ?StoreProduct $command;
    private ?StoreProductHandlerInterface $commandHandler;

    public function setUp(): void
    {
        $this->productFactoryMock = $this->createMock(ProductFactoryInterface::class);
        $this->productRepositoryMock = $this->createMock(ProductRepositoryInterface::class);
        $this->dispatcherMock = $this->createMock(DispatcherInterface::class);

        $this->command = new StoreProduct();
        $this->command->name = 'Product #1';
        $this->command->price = 7.4;

        $reflection = new \ReflectionClass(StoreProductHandler::class);
        $this->commandHandler = $reflection->newInstance(
            $this->productFactoryMock,
            $this->productRepositoryMock,
            $this->dispatcherMock
        );
    }

    public function testExecute__MustCreateProduct(): void
    {
        $product = $this->createMock(Product::class);
        $this->productFactoryMock->expects($this->once())
            ->method('create')
            ->with($this->command->name, $this->command->price)
            ->willReturn($product);

        $this->commandHandler->execute($this->command);
    }

    public function testExecute__MustAddProduct(): void
    {
        $product = $this->createMock(Product::class);
        $this->productFactoryMock->method('create')->willReturn($product);
        $this->productRepositoryMock->expects($this->once())->method('add')->with($product);

        $this->commandHandler->execute($this->command);
    }

    public function testExecute__MustDispatchEvent(): void
    {
        $product = $this->createMock(Product::class);
        $this->productFactoryMock->method('create')->willReturn($product);
        $this->dispatcherMock->expects($this->once())->method('dispatch');

        $this->commandHandler->execute($this->command);
    }
}
