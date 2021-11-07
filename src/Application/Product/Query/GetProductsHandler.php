<?php

namespace Shopph\Application\Product\Query;

use Shopph\Application\Contract\Query\GetProductsHandlerInterface;
use Shopph\Domain\Contract\Model\ProductFinderInterface;

final class GetProductsHandler implements GetProductsHandlerInterface
{
    private ProductFinderInterface $productFinder;

    public function __construct(ProductFinderInterface $productFinder)
    {
        $this->productFinder = $productFinder;
    }

    public function execute(GetProducts $query): GetProductsResponse
    {
        return GetProductsResponse::fromArray(
            $this->productFinder->findAll()
        );
    }
}
