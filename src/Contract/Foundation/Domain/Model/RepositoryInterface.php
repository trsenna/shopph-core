<?php

namespace Shopph\Contract\Foundation\Domain\Model;

interface RepositoryInterface
{
    public function ofIdentity(IdentityInterface $identity): EntityInterface;
}
