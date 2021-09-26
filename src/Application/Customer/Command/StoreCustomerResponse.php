<?php

namespace Shopph\Application\Customer\Command;

use Shopph\Domain\Customer\Model\Customer;

final class StoreCustomerResponse
{
    public string $id;
    public string $name;

    public static function fromEntity(Customer $customer): StoreCustomerResponse
    {
        $response = new static();
        $response->id = $customer->getIdentity()->value();
        $response->name = $customer->getName()->getFullName();

        return $response;
    }
}
