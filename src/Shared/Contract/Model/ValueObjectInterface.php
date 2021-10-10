<?php

namespace Shopph\Shared\Contract\Model;

interface ValueObjectInterface
{
    public function equalsTo(ValueObjectInterface $other): bool;
}
