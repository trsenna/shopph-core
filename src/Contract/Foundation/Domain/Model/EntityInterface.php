<?php

namespace Shopph\Contract\Foundation\Domain\Model;

interface EntityInterface
{
    public function getIdentity(): IdentityInterface;
}
