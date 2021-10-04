<?php

namespace Shopph\Tests;

use Shopph\Contract\Foundation\Model\IdentityInterface;
use Shopph\Shared\Foundation\Model\AbstractEntity;
use Shopph\Shared\Foundation\Model\AbstractIdentity;

if (!function_exists('factory_entity')) {
    function factory_entity(IdentityInterface $identity)
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

if (!function_exists('factory_identity')) {
    function factory_identity(string $value)
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
