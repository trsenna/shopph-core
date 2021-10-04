<?php

namespace Shopph\Tests\Shared;

use Shopph\Contract\Foundation\Model\IdentityInterface;
use Shopph\Shared\Foundation\Model\AbstractEntity;
use Shopph\Shared\Foundation\Model\AbstractIdentity;

trait FactoryHelperTrait
{
    public final function createAbstractEntity(IdentityInterface $identity)
    {
        return new class($identity) extends AbstractEntity
        {
            public function __construct(IdentityInterface $identity)
            {
                parent::__construct($identity);
            }
        };
    }

    public final function createAbstractIdentity(string $value)
    {
        return new class($value) extends AbstractIdentity
        {
            public function __construct(string $value)
            {
                parent::__construct($value);
            }
        };
    }
}
