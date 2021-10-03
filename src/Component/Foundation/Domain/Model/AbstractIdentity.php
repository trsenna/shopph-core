<?php

namespace Shopph\Foundation\Domain\Model;

use Shopph\Contract\Foundation\Domain\Model\IdentityInterface;

use function Shopph\verify;

abstract class AbstractIdentity implements IdentityInterface
{
    protected string $value;

    protected function __construct(string $value)
    {
        verify('value not blank', strlen(trim($value)) !== 0);

        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equalsTo(IdentityInterface $other): bool
    {
        return get_class($this) === get_class($other)
            && $this->value === $other->value;
    }
}
