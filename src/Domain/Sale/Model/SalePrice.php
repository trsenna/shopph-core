<?php

namespace Shopph\Domain\Sale\Model;

use Shopph\Shared\Contract\Model\ValueObjectInterface;
use Shopph\Shared\Model\AbstractValueObject;

class SalePrice extends AbstractValueObject
{
    private float $value;

    public function __construct(float $unitPrice, int $quantity = 1)
    {
        static::verify('unitPrice greater than zero', $unitPrice > 0);
        static::verify('quantity greater than zero', $quantity > 0);

        $this->value = floatval($unitPrice * $quantity);
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
