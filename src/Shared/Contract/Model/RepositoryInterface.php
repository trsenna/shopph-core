<?php

namespace Shopph\Shared\Contract\Model;

interface RepositoryInterface
{
    public function ofIdentity(IdentityInterface $identity): EntityInterface;
}
