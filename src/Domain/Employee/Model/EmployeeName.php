<?php

namespace Shopph\Domain\Employee\Model;

use Shopph\Contract\Shared\Model\ValueObjectInterface;
use Shopph\Shared\Model\AbstractValueObject;

class EmployeeName extends AbstractValueObject
{
    private string $name;

    public function __construct(string $name)
    {
        static::verify('name not blank', strlen(trim($name)) !== 0);

        $this->name = $name;
    }

    public function getFullName()
    {
        return $this->name;
    }

    public function equalsTo(ValueObjectInterface $other): bool
    {
        return get_class($this) === get_class($other)
            && $this->name === $other->name;
    }
}
