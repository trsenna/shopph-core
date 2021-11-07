<?php

namespace Shopph\Application\Sale\Query;

use Shopph\Application\Contract\Query\GetSalesHandlerInterface;
use Shopph\Domain\Contract\Model\SaleFinderInterface;

final class GetSalesHandler implements GetSalesHandlerInterface
{
    private SaleFinderInterface $saleFinder;

    public function __construct(SaleFinderInterface $saleFinder)
    {
        $this->saleFinder = $saleFinder;
    }

    public function execute(GetSales $query): GetSalesResponse
    {
        return GetSalesResponse::fromArray(
            $this->saleFinder->findAll()
        );
    }
}
