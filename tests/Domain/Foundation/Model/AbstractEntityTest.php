<?php

namespace Shopph\Domain\Foundation\Model;

use PHPUnit\Framework\TestCase;
use Shopph\Contract\Foundation\Model\IdentityInterface;

final class AbstractEntityTest extends TestCase
{
    private ?IdentityInterface $identity = null;

    protected function setUp(): void
    {
        $this->identity = AbstractIdentityTest::factory('87ffd646-9ef8-473b-951c-28f53fe8cadc');
    }

    public function testGetIdentityWhenHasIdentityMustReturnIdentity()
    {
        $entity = self::factory($this->identity);
        $this->assertSame($this->identity, $entity->getIdentity());
    }

    private static function factory(IdentityInterface $identity): AbstractEntity
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
