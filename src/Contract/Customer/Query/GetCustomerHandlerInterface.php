<?php

namespace Shopph\Contract\Customer\Query;

use Shopph\Application\Customer\Query\GetCustomer;
use Shopph\Application\Customer\Query\GetCustomerResponse;

interface GetCustomerHandlerInterface
{
    public function execute(GetCustomer $query): GetCustomerResponse;
}
