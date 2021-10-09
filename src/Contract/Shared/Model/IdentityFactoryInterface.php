<?php

namespace Shopph\Contract\Shared\Model;

interface IdentityFactoryInterface
{
    public function create(): IdentityInterface;
    public function valueOf(string $value): IdentityInterface;
}
