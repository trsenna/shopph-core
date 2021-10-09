<?php

namespace Shopph\Tests\Shared\Helper;

use Shopph\Contract\Shared\Model\IdentityInterface;
use Shopph\Shared\Model\AbstractEntity;

trait EntityFakeTrait
{
    public final function fakeEntity(IdentityInterface $identity)
    {
        return new class($identity) extends AbstractEntity
        {
            public function __construct(IdentityInterface $identity)
            {
                parent::__construct($identity);
            }
        };
    }
}
