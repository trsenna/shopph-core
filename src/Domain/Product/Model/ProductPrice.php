<?php

namespace Shopph\Domain\Product\Model;

use Shopph\Contract\Shared\Model\ValueObjectInterface;
use Shopph\Shared\Model\AbstractValueObject;

final class ProductPrice extends AbstractValueObject
{
    private float $value;

    public function __construct(float $value)
    {
        static::verify('value greater than zero', $value > 0);

        $this->value = $value;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function equalsTo(ValueObjectInterface $other): bool
    {
        return get_class($this) === get_class($other)
            && $this->value === $other->value;
    }
}
