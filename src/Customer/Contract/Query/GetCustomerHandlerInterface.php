<?php

namespace Shopph\Customer\Contract\Query;

use Shopph\Customer\Application\Query\GetCustomer;
use Shopph\Customer\Application\Query\GetCustomerResponse;

interface GetCustomerHandlerInterface
{
    public function execute(GetCustomer $query): GetCustomerResponse;
}
