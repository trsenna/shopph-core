<?php

namespace Shopph\Contract\Customer\Model;

use Shopph\Domain\Customer\Model\Customer;

interface CustomerFactoryInterface
{
    public function create(string $name): Customer;
}
