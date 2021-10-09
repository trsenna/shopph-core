<?php

namespace Shopph\Tests\Shared\Helper;

use Shopph\Shared\Model\AbstractIdentity;

trait IdentityFakeTrait
{
    public final function fakeIdentity(string $value)
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
