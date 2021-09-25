<?php

namespace Shopph\Contract\Customer\Model;

use Shopph\Contract\Foundation\Model\RepositoryInterface;
use Shopph\Domain\Customer\Model\Customer;

interface CustomerRepositoryInterface extends RepositoryInterface
{
    public function add(Customer $customer): void;
}
