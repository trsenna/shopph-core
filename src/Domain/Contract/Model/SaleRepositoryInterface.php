<?php

namespace Shopph\Domain\Contract\Model;

use Shopph\Domain\Sale\Model\Sale;
use Shopph\Shared\Contract\Model\RepositoryInterface;

interface SaleRepositoryInterface extends RepositoryInterface
{
    public function add(Sale $sale): void;
}
