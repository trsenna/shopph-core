<?php

namespace Shopph\Contract\Customer\Application\Query;

use Shopph\Customer\Application\Query\GetCustomer;
use Shopph\Customer\Application\Query\GetCustomerResponse;

interface GetCustomerHandlerInterface
{
    public function execute(GetCustomer $query): GetCustomerResponse;
}
