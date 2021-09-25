<?php

namespace Shopph\Contract\Foundation\Model;

interface ValueObjectInterface
{
    public function equalsTo(ValueObjectInterface $other): bool;
}
