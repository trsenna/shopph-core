<?php

namespace Shopph\Customer\Domain\Model;

use Shopph\Contract\Foundation\Model\ValueObjectInterface;
use Shopph\Shared\Foundation\Model\AbstractValueObject;

class CustomerName extends AbstractValueObject
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
