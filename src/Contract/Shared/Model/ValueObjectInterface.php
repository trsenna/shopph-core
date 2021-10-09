<?php

namespace Shopph\Contract\Shared\Model;

interface ValueObjectInterface
{
    public function equalsTo(ValueObjectInterface $other): bool;
}
