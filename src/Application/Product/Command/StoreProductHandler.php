<?php

namespace Shopph\Application\Product\Command;

use Shopph\Application\Contract\Command\StoreProductHandlerInterface;
use Shopph\Application\Product\Event\StoredProduct;
use Shopph\Domain\Contract\Model\ProductFactoryInterface;
use Shopph\Domain\Contract\Model\ProductRepositoryInterface;
use Shopph\Shared\Contract\Event\DispatcherInterface;

final class StoreProductHandler implements StoreProductHandlerInterface
{
    private ProductFactoryInterface $productFactory;
    private ProductRepositoryInterface $productRepository;
    private DispatcherInterface $dispatcher;

    public function __construct(
        ProductFactoryInterface $productFactory,
        ProductRepositoryInterface $productRepository,
        DispatcherInterface $dispatcher
    ) {
        $this->productFactory = $productFactory;
        $this->productRepository = $productRepository;
        $this->dispatcher = $dispatcher;
    }

    public function execute(StoreProduct $command): void
    {
        $product = $this->productFactory->create($command->name, $command->price);
        $this->productRepository->add($product);

        $storedProductEvent = StoredProduct::fromEntity($product);
        $this->dispatcher->dispatch($storedProductEvent);
    }
}
