<?php

namespace Shopph\Contract\Shared\Model;

interface IdentityInterface
{
    public function value(): string;
    public function equalsTo(IdentityInterface $other): bool;
}
