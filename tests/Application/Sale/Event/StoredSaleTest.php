<?php

namespace Shopph\Tests\Application\Sale\Event;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Shopph\Application\Sale\Event\StoredSale;
use Shopph\Domain\Sale\Model\Sale;
use Shopph\Domain\Sale\Model\SalePrice;
use Shopph\Shared\Contract\Model\IdentityInterface;

final class StoredSaleTest extends TestCase
{
    private ?String $uuid4Value;
    private ?MockObject $saleIdentity;
    private ?MockObject $productIdentity;
    private ?MockObject $employeeIdentity;
    private ?MockObject $customerIdentity;
    private ?SalePrice $salePrice;
    private ?\DateTime $saleDate;
    private ?Sale $sale;

    public function setUp(): void
    {
        $this->uuid4Value = '87ffd646-9ef8-473b-951c-28f53fe8cadc';
        $this->saleIdentity = $this->createMock(IdentityInterface::class);
        $this->customerIdentity = $this->createMock(IdentityInterface::class);
        $this->employeeIdentity = $this->createMock(IdentityInterface::class);
        $this->productIdentity = $this->createMock(IdentityInterface::class);

        $this->salePrice = new SalePrice(7, 3);
        $this->saleDate = new \DateTime();

        $saleCass = new \ReflectionClass(Sale::class);
        $this->sale = $saleCass->newInstance(
            $this->saleIdentity,
            $this->productIdentity,
            $this->employeeIdentity,
            $this->customerIdentity,
            $this->salePrice,
            $this->saleDate,
        );
    }

    public function testFromEntity__MustHaveId(): void
    {
        $this->saleIdentity->method('value')->willReturn($this->uuid4Value);

        $event = StoredSale::fromEntity($this->sale);
        $this->assertEquals($this->uuid4Value, $event->id);
    }

    public function testFromEntity__MustHaveProductId(): void
    {
        $this->productIdentity->method('value')->willReturn($this->uuid4Value);

        $event = StoredSale::fromEntity($this->sale);
        $this->assertEquals($this->uuid4Value, $event->productId);
    }

    public function testFromEntity__MustHaveEmployeeId(): void
    {
        $this->employeeIdentity->method('value')->willReturn($this->uuid4Value);

        $event = StoredSale::fromEntity($this->sale);
        $this->assertEquals($this->uuid4Value, $event->employeeId);
    }

    public function testFromEntity__MustHaveCustomerId(): void
    {
        $this->customerIdentity->method('value')->willReturn($this->uuid4Value);

        $event = StoredSale::fromEntity($this->sale);
        $this->assertEquals($this->uuid4Value, $event->customerId);
    }

    public function testFromEntity__MustHavePrice(): void
    {
        $event = StoredSale::fromEntity($this->sale);
        $this->assertEquals($this->salePrice->getValue(), $event->price);
    }

    public function testFromEntity__MustHaveDate(): void
    {
        $event = StoredSale::fromEntity($this->sale);
        $this->assertSame($this->saleDate, $event->date);
    }
}
