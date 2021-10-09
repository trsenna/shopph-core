<?php

namespace Shopph\Contract\Shared\Model;

interface RepositoryInterface
{
    public function ofIdentity(IdentityInterface $identity): EntityInterface;
}
