<?php

namespace Shopph\Tests\Domain\Foundation\Model;

use PHPUnit\Framework\TestCase;
use Shopph\Contract\Foundation\Model\IdentityInterface;

use function Shopph\Tests\factory_entity;
use function Shopph\Tests\factory_identity;

final class AbstractEntityTest extends TestCase
{
    private ?IdentityInterface $identity = null;

    protected function setUp(): void
    {
        $this->identity = factory_identity('87ffd646-9ef8-473b-951c-28f53fe8cadc');
    }

    public function testGetIdentityWhenHasIdentityMustReturnIdentity()
    {
        $entity = factory_entity($this->identity);
        $this->assertSame($this->identity, $entity->getIdentity());
    }
}
