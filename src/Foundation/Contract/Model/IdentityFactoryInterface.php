<?php

namespace Shopph\Foundation\Contract\Model;

interface IdentityFactoryInterface
{
    public function create(): IdentityInterface;
    public function valueOf(string $value): IdentityInterface;
}
