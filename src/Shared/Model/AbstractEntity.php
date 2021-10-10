<?php

namespace Shopph\Shared\Model;

use Shopph\Shared\Contract\Model\EntityInterface;
use Shopph\Shared\Contract\Model\IdentityInterface;
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
