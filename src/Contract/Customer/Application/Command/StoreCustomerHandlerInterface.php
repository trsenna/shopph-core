<?php

namespace Shopph\Contract\Customer\Application\Command;

use Shopph\Customer\Application\Command\StoreCustomer;

interface StoreCustomerHandlerInterface
{
    public function execute(StoreCustomer $command): void;
}
