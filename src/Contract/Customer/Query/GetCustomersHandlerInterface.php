<?php

namespace Shopph\Contract\Customer\Query;

use Shopph\Application\Customer\Query\GetCustomers;
use Shopph\Application\Customer\Query\GetCustomersResponse;

interface GetCustomersHandlerInterface
{
    public function execute(GetCustomers $query): GetCustomersResponse;
}
