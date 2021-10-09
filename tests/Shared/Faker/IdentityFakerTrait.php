<?php

namespace Shopph\Tests\Shared\Faker;

use Shopph\Shared\Model\AbstractIdentity;

trait IdentityFakerTrait
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
