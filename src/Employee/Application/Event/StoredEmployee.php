<?php

namespace Shopph\Employee\Application\Event;

use Shopph\Contract\Shared\Event\EventInterface;
use Shopph\Domain\Employee\Model\Employee;

final class StoredEmployee implements EventInterface
{
    public string $id;
    public string $name;

    public static function fromEntity(Employee $employee): StoredEmployee
    {
        $event = new static();
        $event->id = $employee->getIdentity()->value();
        $event->name = $employee->getName()->getFullName();

        return $event;
    }
}
