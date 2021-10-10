<?php

namespace Shopph\Tests\Shared\Model;

use PHPUnit\Framework\TestCase;
use Shopph\Shared\Contract\Model\IdentityInterface;
use Shopph\Tests\Shared\Faker\EntityFakerTrait;
use Shopph\Tests\Shared\Faker\IdentityFakerTrait;

final class AbstractEntityTest extends TestCase
{
    use EntityFakerTrait;
    use IdentityFakerTrait;

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
