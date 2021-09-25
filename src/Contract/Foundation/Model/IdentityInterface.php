<?php

namespace Shopph\Contract\Foundation\Model;

interface IdentityInterface
{
    public function value(): string;
    public function equalsTo(IdentityInterface $other): bool;
}
