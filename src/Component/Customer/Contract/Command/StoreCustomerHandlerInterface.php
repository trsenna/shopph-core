<?php

namespace Shopph\Customer\Contract\Command;

use Shopph\Customer\Application\Command\StoreCustomer;

interface StoreCustomerHandlerInterface
{
    public function execute(StoreCustomer $command): void;
}
