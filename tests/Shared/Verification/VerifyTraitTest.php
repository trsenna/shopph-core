<?php

namespace Shopph\Tests\Shared\Verification;

use PHPUnit\Framework\TestCase;
use Shopph\Shared\Verification\VerifyException;
use Shopph\Shared\Verification\VerifyTrait;

final class VerifyTraitTest extends TestCase
{
    use VerifyTrait;

    public function testVerifyWhenConditionTrueMustNotThrowException(): void
    {
        static::verify('any value', true);
        $this->assertTrue(true);
    }

    public function testVerifyWhenConditionFalseMustThrowException(): void
    {
        try {
            static::verify('any value', false);
            $this->fail();
        } catch (VerifyException $e) {
            $this->assertNotEmpty($e->getMessage());
        }
    }

    public function testVerifyWhenConditionFalseMustHaveConstraintNameWithinExceptionMessage(): void
    {
        try {
            static::verify('any value', false);
            $this->fail();
        } catch (VerifyException $e) {
            $this->assertStringContainsString('any value', $e->getMessage());
        }
    }
}
