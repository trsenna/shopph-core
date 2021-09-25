<?php

namespace Shopph\Domain\Foundation\Model;

use PHPUnit\Framework\TestCase;

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
        $identity = self::factoryIdentity($this->uuid4);
        $this->assertEquals($this->uuid4, $identity->value());
    }

    public function testEqualsToWhenSameInstanceMustReturnTrue(): void
    {
        $identity = self::factoryIdentity($this->uuid4);
        $this->assertTrue($identity->equalsTo($identity));
    }

    public function testEqualsToWhenSameValueMustReturnTrue(): void
    {
        $identity = self::factoryIdentity($this->uuid4);
        $identityOther = self::factoryIdentity($this->uuid4);
        $this->assertTrue($identity->equalsTo($identityOther));
    }

    public function testEqualsToWhenNotSameValueMustReturnFalse(): void
    {
        $identity = self::factoryIdentity($this->uuid4);
        $identityOther = self::factoryIdentity($this->uuid4Other);
        $this->assertFalse($identity->equalsTo($identityOther));
    }

    private static function factoryIdentity(string $value): AbstractIdentity
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
