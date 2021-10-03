<?php

namespace Shopph\Shared\Verification;

trait VerifyTrait
{
    public static function verify(string $constraintName, bool $condition)
    {
        if (!$condition) {
            throw new VerifyException("contraint violated: {$constraintName}");
        }
    }
}
