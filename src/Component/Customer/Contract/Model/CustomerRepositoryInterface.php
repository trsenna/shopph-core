<?php

namespace Shopph\Customer\Contract\Model;

use Shopph\Customer\Domain\Model\Customer;
use Shopph\Foundation\Contract\Model\RepositoryInterface;

interface CustomerRepositoryInterface extends RepositoryInterface
{
    public function add(Customer $customer): void;
}
