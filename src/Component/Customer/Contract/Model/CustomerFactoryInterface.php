<?php

namespace Shopph\Customer\Contract\Model;

use Shopph\Customer\Domain\Model\Customer;

interface CustomerFactoryInterface
{
    public function create(string $name): Customer;
}
