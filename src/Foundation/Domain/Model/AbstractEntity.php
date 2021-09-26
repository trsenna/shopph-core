<?php

namespace Shopph\Foundation\Domain\Model;

use Shopph\Foundation\Contract\Model\EntityInterface;
use Shopph\Foundation\Contract\Model\IdentityInterface;

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
