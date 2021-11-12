<?php

namespace Shopph\Tests\Application\Product\Command;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Shopph\Application\Contract\Command\StoreProductHandlerInterface;
use Shopph\Application\Product\Command\StoreProduct;
use Shopph\Application\Product\Command\StoreProductHandler;
use Shopph\Application\Product\Event\StoredProduct;
use Shopph\Domain\Contract\Model\ProductFactoryInterface;
use Shopph\Domain\Contract\Model\ProductRepositoryInterface;
use Shopph\Domain\Product\Model\Product;
use Shopph\Shared\Contract\Event\DispatcherInterface;

final class StoreProductHandlerTest extends TestCase
{
    private ?MockObject $productFactory;
    private ?MockObject $productRepository;
    private ?MockObject $dispatcher;

    private ?StoreProduct $command;
    private ?StoreProductHandlerInterface $commandHandler;

    public function setUp(): void
    {
        $this->productFactory = $this->createMock(ProductFactoryInterface::class);
        $this->productRepository = $this->createMock(ProductRepositoryInterface::class);
        $this->dispatcher = $this->createMock(DispatcherInterface::class);

        $this->command = new StoreProduct();
        $this->command->name = 'Product #1';
        $this->command->price = 7.4;

        $reflection = new \ReflectionClass(StoreProductHandler::class);
        $this->commandHandler = $reflection->newInstance(
            $this->productFactory,
            $this->productRepository,
            $this->dispatcher
        );
    }

    public function testExecute__MustCreateProduct(): void
    {
        $product = $this->createMock(Product::class);
        $this->productFactory->expects($this->once())
            ->method('create')
            ->with($this->command->name, $this->command->price)
            ->willReturn($product);

        $this->commandHandler->execute($this->command);
    }

    public function testExecute__MustAddProduct(): void
    {
        $product = $this->createMock(Product::class);
        $this->productFactory->method('create')->willReturn($product);
        $this->productRepository->expects($this->once())->method('add')->with($product);

        $this->commandHandler->execute($this->command);
    }

    public function testExecute__MustDispatchEvent(): void
    {
        $product = $this->createMock(Product::class);
        $this->productFactory->method('create')->willReturn($product);
        $this->dispatcher->expects($this->once())
            ->method('dispatch')
            ->with($this->isInstanceOf(StoredProduct::class));

        $this->commandHandler->execute($this->command);
    }
}
