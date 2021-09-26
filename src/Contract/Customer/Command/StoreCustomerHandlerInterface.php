<?php

namespace Shopph\Contract\Customer\Command;

use Shopph\Application\Customer\Command\StoreCustomer;

interface StoreCustomerHandlerInterface
{
    public function execute(StoreCustomer $command): void;
}
