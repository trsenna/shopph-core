<?php

namespace Shopph\Contract\Customer\Domain\Model;

use Shopph\Contract\Foundation\Domain\Model\RepositoryInterface;
use Shopph\Customer\Domain\Model\Customer;

interface CustomerRepositoryInterface extends RepositoryInterface
{
    public function add(Customer $customer): void;
}
