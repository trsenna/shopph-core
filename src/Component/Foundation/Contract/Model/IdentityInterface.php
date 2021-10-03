<?php

namespace Shopph\Foundation\Contract\Model;

interface IdentityInterface
{
    public function value(): string;
    public function equalsTo(IdentityInterface $other): bool;
}
