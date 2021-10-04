<?php

namespace Shopph\Shared\Foundation\Model;

use Shopph\Contract\Foundation\Model\ValueObjectInterface;
use Shopph\Shared\Verification\VerifyTrait;

abstract class AbstractValueObject implements ValueObjectInterface
{
    use VerifyTrait;
}
