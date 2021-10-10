<?php

namespace Shopph\Domain\Contract\Model;

use Shopph\Domain\Customer\Model\Customer;
use Shopph\Shared\Contract\Model\RepositoryInterface;

interface CustomerRepositoryInterface extends RepositoryInterface
{
    public function add(Customer $customer): void;
}
