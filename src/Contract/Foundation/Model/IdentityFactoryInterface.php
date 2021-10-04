<?php

namespace Shopph\Contract\Foundation\Model;

interface IdentityFactoryInterface
{
    public function create(): IdentityInterface;
    public function valueOf(string $value): IdentityInterface;
}
