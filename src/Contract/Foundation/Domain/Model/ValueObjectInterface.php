<?php

namespace Shopph\Contract\Foundation\Domain\Model;

interface ValueObjectInterface
{
    public function equalsTo(ValueObjectInterface $other): bool;
}
