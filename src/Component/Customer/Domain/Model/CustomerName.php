<?php

namespace Shopph\Customer\Domain\Model;

use Shopph\Contract\Foundation\Domain\Model\ValueObjectInterface;

use function Shopph\verify;

class CustomerName implements ValueObjectInterface
{
    private string $name;

    public function __construct(string $name)
    {
        verify('name not blank', strlen(trim($name)) !== 0);

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
