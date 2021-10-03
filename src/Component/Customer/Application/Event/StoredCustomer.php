<?php

namespace Shopph\Customer\Application\Event;

use Shopph\Customer\Domain\Model\Customer;
use Shopph\Foundation\Contract\Event\EventInterface;

final class StoredCustomer implements EventInterface
{
    public string $id;
    public string $name;

    public static function fromEntity(Customer $customer): StoredCustomer
    {
        $event = new static();
        $event->id = $customer->getIdentity()->value();
        $event->name = $customer->getName()->getFullName();

        return $event;
    }
}
