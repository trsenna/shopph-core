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
    private ?MockObject $saleIdentityMock;
    private ?MockObject $productIdentityMock;
    private ?MockObject $employeeIdentityMock;
    private ?MockObject $customerIdentityMock;
    private ?SalePrice $salePrice;
    private ?\DateTime $saleDate;
    private ?Sale $sale;

    public function setUp(): void
    {
        $this->uuid4Value = '87ffd646-9ef8-473b-951c-28f53fe8cadc';
        $this->saleIdentityMock = $this->createMock(IdentityInterface::class);
        $this->customerIdentityMock = $this->createMock(IdentityInterface::class);
        $this->employeeIdentityMock = $this->createMock(IdentityInterface::class);
        $this->productIdentityMock = $this->createMock(IdentityInterface::class);

        $this->salePrice = new SalePrice(7, 3);
        $this->saleDate = new \DateTime();

        $saleCass = new \ReflectionClass(Sale::class);
        $this->sale = $saleCass->newInstance(
            $this->saleIdentityMock,
            $this->productIdentityMock,
            $this->employeeIdentityMock,
            $this->customerIdentityMock,
            $this->salePrice,
            $this->saleDate,
        );
    }

    public function testFromEntity__MustHaveId(): void
    {
        $this->saleIdentityMock->method('value')->willReturn($this->uuid4Value);

        $event = StoredSale::fromEntity($this->sale);
        $this->assertEquals($this->uuid4Value, $event->id);
    }

    public function testFromEntity__MustHaveProductId(): void
    {
        $this->productIdentityMock->method('value')->willReturn($this->uuid4Value);

        $event = StoredSale::fromEntity($this->sale);
        $this->assertEquals($this->uuid4Value, $event->productId);
    }

    public function testFromEntity__MustHaveEmployeeId(): void
    {
        $this->employeeIdentityMock->method('value')->willReturn($this->uuid4Value);

        $event = StoredSale::fromEntity($this->sale);
        $this->assertEquals($this->uuid4Value, $event->employeeId);
    }

    public function testFromEntity__MustHaveCustomerId(): void
    {
        $this->customerIdentityMock->method('value')->willReturn($this->uuid4Value);

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
