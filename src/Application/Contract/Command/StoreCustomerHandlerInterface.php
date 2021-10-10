<?php

namespace Shopph\Application\Contract\Command;

use Shopph\Application\Customer\Command\StoreCustomer;

interface StoreCustomerHandlerInterface
{
    public function execute(StoreCustomer $command): void;
}
