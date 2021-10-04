<?php

namespace Shopph\Tests\Foundation\Domain\Model;

use PHPUnit\Framework\TestCase;
use Shopph\Contract\Foundation\Model\IdentityInterface;
use Shopph\Tests\Shared\FactoryHelperTrait;

final class AbstractEntityTest extends TestCase
{
    use FactoryHelperTrait;

    private ?IdentityInterface $identity = null;

    protected function setUp(): void
    {
        $this->identity = $this->createAbstractIdentity('87ffd646-9ef8-473b-951c-28f53fe8cadc');
    }

    public function testGetIdentityWhenHasIdentityMustReturnIdentity()
    {
        $entity = $this->createAbstractEntity($this->identity);
        $this->assertSame($this->identity, $entity->getIdentity());
    }
}
