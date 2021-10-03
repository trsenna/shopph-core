<?php

namespace Shopph\Contract\Customer\Domain\Model;

use Shopph\Customer\Domain\Model\Customer;

interface CustomerFactoryInterface
{
    public function create(string $name): Customer;
}
