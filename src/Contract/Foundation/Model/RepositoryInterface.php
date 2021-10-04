<?php

namespace Shopph\Contract\Foundation\Model;

interface RepositoryInterface
{
    public function ofIdentity(IdentityInterface $identity): EntityInterface;
}
