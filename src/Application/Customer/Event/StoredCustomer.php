<?php

namespace Shopph\Application\Customer\Event;

use Shopph\Domain\Customer\Model\Customer;
use Shopph\Shared\Contract\Event\EventInterface;

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
