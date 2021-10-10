<?php

namespace Shopph\Customer\Application\Event;

use Shopph\Contract\Shared\Event\EventInterface;
use Shopph\Domain\Customer\Model\Customer;

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
