<?php

namespace Shopph\Shared\Model;

use Shopph\Contract\Shared\Model\EntityInterface;
use Shopph\Contract\Shared\Model\IdentityInterface;

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
