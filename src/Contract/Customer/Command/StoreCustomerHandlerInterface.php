<?php

namespace Shopph\Contract\Customer\Command;

use Shopph\Application\Customer\Command\StoreCustomer;
use Shopph\Application\Customer\Command\StoreCustomerResponse;

interface StoreCustomerHandlerInterface
{
    public function execute(StoreCustomer $command): StoreCustomerResponse;
}
