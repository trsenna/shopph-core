<?php

namespace Shopph\Contract\Customer\Application\Query;

use Shopph\Customer\Application\Query\GetCustomers;
use Shopph\Customer\Application\Query\GetCustomersResponse;

interface GetCustomersHandlerInterface
{
    public function execute(GetCustomers $query): GetCustomersResponse;
}
