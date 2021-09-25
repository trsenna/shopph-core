<?php

namespace Shopph\Domain\Foundation\Model;

use Shopph\Contract\Foundation\Model\EntityInterface;
use Shopph\Contract\Foundation\Model\IdentityInterface;

abstract class AbstractEntity implements EntityInterface
{
    protected IdentityInterface $identity;

    protected function __construct(IdentityInterface $identity)
    {
        $this->identity = $identity;
    }

    public function getIdentity(): IdentityInterface
    {
        return $this->identity;
    }
}
