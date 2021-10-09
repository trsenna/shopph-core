<?php

namespace Shopph\Shared\Model;

use Shopph\Contract\Shared\Model\ValueObjectInterface;
use Shopph\Shared\Verification\VerifyTrait;

abstract class AbstractValueObject implements ValueObjectInterface
{
    use VerifyTrait;
}
