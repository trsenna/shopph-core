<?php

namespace Shopph\Tests\Shared\Model;

use PHPUnit\Framework\TestCase;
use Shopph\Shared\Verification\VerifyException;
use Shopph\Tests\Shared\Faker\IdentityFakerTrait;

final class AbstractIdentityTest extends TestCase
{
    use IdentityFakerTrait;

    private ?string $uuid4 = null;
    private ?string $uuid4Other = null;

    protected function setUp(): void
    {
        $this->uuid4 = '87ffd646-9ef8-473b-951c-28f53fe8cadc';
        $this->uuid4Other = 'a62fb33e-e067-4979-9f16-7871c2be6660';
    }

    public function testValueWhenValueWithUUID4MustReturnUUID4String(): void
    {
        $identity = $this->fakeIdentity($this->uuid4);
        $this->assertEquals($this->uuid4, $identity->value());
    }

    public function testEqualsToWhenSameInstanceMustReturnTrue(): void
    {
        $identity = $this->fakeIdentity($this->uuid4);
        $this->assertTrue($identity->equalsTo($identity));
    }

    public function testEqualsToWhenSameValueMustReturnTrue(): void
    {
        $identity = $this->fakeIdentity($this->uuid4);
        $identityOther = $this->fakeIdentity($this->uuid4);
        $this->assertTrue($identity->equalsTo($identityOther));
    }

    public function testEqualsToWhenNotSameValueMustReturnFalse(): void
    {
        $identity = $this->fakeIdentity($this->uuid4);
        $identityOther = $this->fakeIdentity($this->uuid4Other);
        $this->assertFalse($identity->equalsTo($identityOther));
    }

    public function testCreateWhenValueIsBlankMustThrowException(): void
    {
        try {
            $this->fakeIdentity(' ');
            $this->fail();
        } catch (VerifyException $e) {
            $this->assertStringContainsString('value', $e->getMessage());
            $this->assertStringContainsString('not blank', $e->getMessage());
        }
    }
}
