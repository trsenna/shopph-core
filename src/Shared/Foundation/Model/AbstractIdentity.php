<?php

namespace Shopph\Shared\Foundation\Model;

use Shopph\Contract\Foundation\Model\IdentityInterface;
use Shopph\Shared\Verification\VerifyTrait;

abstract class AbstractIdentity implements IdentityInterface
{
    use VerifyTrait;

    protected string $value;

    protected function __construct(string $value)
    {
        static::verify('value not blank', strlen(trim($value)) !== 0);

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
