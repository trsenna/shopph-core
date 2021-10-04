<?php

namespace Shopph\Tests\Foundation\Domain\Model;

use PHPUnit\Framework\TestCase;
use Shopph\Contract\Foundation\Model\IdentityInterface;
use Shopph\Tests\Shared\Helper\EntityFakeTrait;
use Shopph\Tests\Shared\Helper\IdentityFakeTrait;

final class AbstractEntityTest extends TestCase
{
    use EntityFakeTrait;
    use IdentityFakeTrait;

    private ?IdentityInterface $identity = null;

    protected function setUp(): void
    {
        $this->identity = $this->fakeIdentity('87ffd646-9ef8-473b-951c-28f53fe8cadc');
    }

    public function testGetIdentityWhenHasIdentityMustReturnIdentity()
    {
        $entity = $this->fakeEntity($this->identity);
        $this->assertSame($this->identity, $entity->getIdentity());
    }
}
