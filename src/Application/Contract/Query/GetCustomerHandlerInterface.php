<?php

namespace Shopph\Application\Contract\Query;

use Shopph\Application\Customer\Query\GetCustomer;
use Shopph\Application\Customer\Query\GetCustomerResponse;

interface GetCustomerHandlerInterface
{
    public function execute(GetCustomer $query): GetCustomerResponse;
}
