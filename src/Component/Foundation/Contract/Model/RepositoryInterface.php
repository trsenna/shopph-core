<?php

namespace Shopph\Foundation\Contract\Model;

interface RepositoryInterface
{
    public function ofIdentity(IdentityInterface $identity): EntityInterface;
}
