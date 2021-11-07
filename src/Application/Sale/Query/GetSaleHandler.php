<?php

namespace Shopph\Application\Sale\Query;

use Shopph\Application\Contract\Query\GetSaleHandlerInterface;
use Shopph\Domain\Contract\Model\SaleFinderInterface;

final class GetSaleHandler implements GetSaleHandlerInterface
{
    private SaleFinderInterface $saleFinder;

    public function __construct(SaleFinderInterface $saleFinder)
    {
        $this->saleFinder = $saleFinder;
    }

    public function execute(GetSale $query): GetSaleResponse
    {
        return GetSaleResponse::fromObject(
            $this->saleFinder->findOne($query->id)
        );
    }
}
