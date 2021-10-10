<?php

namespace Shopph\Application\Employee\Event;

use Shopph\Domain\Employee\Model\Employee;
use Shopph\Shared\Contract\Event\EventInterface;

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
