<?php

namespace Shopph\Tests\Shared\Foundation\Model;

use PHPUnit\Framework\TestCase;
use Shopph\Shared\Verification\VerifyException;

use function Shopph\Tests\factory_identity;

final class AbstractIdentityTest extends TestCase
{
    private ?string $uuid4 = null;
    private ?string $uuid4Other = null;

    protected function setUp(): void
    {
        $this->uuid4 = '87ffd646-9ef8-473b-951c-28f53fe8cadc';
        $this->uuid4Other = 'a62fb33e-e067-4979-9f16-7871c2be6660';
    }

    public function testValueWhenValueWithUUID4MustReturnUUID4String(): void
    {
        $identity = factory_identity($this->uuid4);
        $this->assertEquals($this->uuid4, $identity->value());
    }

    public function testEqualsToWhenSameInstanceMustReturnTrue(): void
    {
        $identity = factory_identity($this->uuid4);
        $this->assertTrue($identity->equalsTo($identity));
    }

    public function testEqualsToWhenSameValueMustReturnTrue(): void
    {
        $identity = factory_identity($this->uuid4);
        $identityOther = factory_identity($this->uuid4);
        $this->assertTrue($identity->equalsTo($identityOther));
    }

    public function testEqualsToWhenNotSameValueMustReturnFalse(): void
    {
        $identity = factory_identity($this->uuid4);
        $identityOther = factory_identity($this->uuid4Other);
        $this->assertFalse($identity->equalsTo($identityOther));
    }

    public function testCreateWhenValueIsBlankMustThrowException(): void
    {
        try {
            factory_identity(' ');
            $this->fail();
        } catch (VerifyException $e) {
            $this->assertStringContainsString('value', $e->getMessage());
            $this->assertStringContainsString('not blank', $e->getMessage());
        }
    }
}
