<?php

namespace Shopph\Domain\Contract\Model;

use Shopph\Contract\Shared\Model\RepositoryInterface;
use Shopph\Domain\Customer\Model\Customer;

interface CustomerRepositoryInterface extends RepositoryInterface
{
    public function add(Customer $customer): void;
}
