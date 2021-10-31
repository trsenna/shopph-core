<?php

namespace Shopph\Application\Contract\Command;

use Shopph\Application\Sale\Command\StoreSale;

interface StoreSaleHandlerInterface
{
    public function execute(StoreSale $command): void;
}
