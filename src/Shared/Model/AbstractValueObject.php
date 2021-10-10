<?php

namespace Shopph\Shared\Model;

use Shopph\Shared\Contract\Model\ValueObjectInterface;
use Shopph\Shared\Verification\VerifyTrait;

abstract class AbstractValueObject implements ValueObjectInterface
{
    use VerifyTrait;
}
