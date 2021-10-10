<?php

namespace Shopph\Shared\Model;

use Shopph\Contract\Shared\Model\EntityInterface;
use Shopph\Contract\Shared\Model\IdentityInterface;
use Shopph\Shared\Verification\VerifyTrait;

abstract class AbstractEntity implements EntityInterface
{
    use VerifyTrait;

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
