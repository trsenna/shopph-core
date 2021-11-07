<?php

namespace Shopph\Application\Product\Query;

use Shopph\Application\Contract\Query\GetProductHandlerInterface;
use Shopph\Domain\Contract\Model\ProductFinderInterface;

final class GetProductHandler implements GetProductHandlerInterface
{
    private ProductFinderInterface $productFinder;

    public function __construct(ProductFinderInterface $productFinder)
    {
        $this->productFinder = $productFinder;
    }

    public function execute(GetProduct $query): GetProductResponse
    {
        return GetProductResponse::fromObject(
            $this->productFinder->findOne($query->id)
        );
    }
}
