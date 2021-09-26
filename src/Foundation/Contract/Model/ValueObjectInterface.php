<?php

namespace Shopph\Foundation\Contract\Model;

interface ValueObjectInterface
{
    public function equalsTo(ValueObjectInterface $other): bool;
}
