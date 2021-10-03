<?php

namespace Shopph\Contract\Foundation\Domain\Model;

interface IdentityFactoryInterface
{
    public function create(): IdentityInterface;
    public function valueOf(string $value): IdentityInterface;
}
