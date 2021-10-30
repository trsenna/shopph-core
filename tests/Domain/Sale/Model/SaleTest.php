<?php

namespace Shopph\Tests\Domain\Product\Model;

use PHPUnit\Framework\TestCase;
use Shopph\Domain\Sale\Model\Sale;
use Shopph\Domain\Sale\Model\SalePrice;
use Shopph\Shared\Contract\Model\IdentityInterface;
use Shopph\Tests\Shared\Faker\IdentityFakerTrait;

final class SaleTest extends TestCase
{
    use IdentityFakerTrait;

    private ?IdentityInterface $identity;
    private ?IdentityInterface $productId;
    private ?IdentityInterface $employeeId;
    private ?IdentityInterface $customerId;
    private ?SalePrice $salePrice;
    private ?\DateTime $date;

    public function setUp(): void
    {
        $this->identity = $this->fakeIdentity('87ffd646-9ef8-473b-951c-28f53fe8cadc');
        $this->productId = $this->fakeIdentity('1922c9dc-1869-4b69-bfc2-b10ee355e4ff');
        $this->employeeId = $this->fakeIdentity('4837bd58-9b75-4dc2-b881-2f72947fb123');
        $this->customerId = $this->fakeIdentity('263d3f42-9057-420e-ae06-ed0c805026a9');
        $this->salePrice = new SalePrice(5, 2);
        $this->date = new \DateTime();
    }

    public function testGetProductIdMustReturnProductId(): void
    {
        $sale = $this->createSale();
        $this->assertEquals($this->productId, $sale->getProductId());
    }

    public function testGetEmployeeIdMustReturnEmployeeId(): void
    {
        $sale = $this->createSale();
        $this->assertEquals($this->employeeId, $sale->getEmployeeId());
    }

    public function testGetCustomerIdMustReturnCustomerId(): void
    {
        $sale = $this->createSale();
        $this->assertEquals($this->customerId, $sale->getCustomerId());
    }

    public function testGetPriceMustReturnPrice(): void
    {
        $sale = $this->createSale();
        $this->assertEquals(10, $sale->getPrice()->getValue());
    }

    public function testGetDateMustReturnDate()
    {
        $sale = $this->createSale();
        $this->assertSame($this->date, $sale->getDate());
    }

    private function createSale(): Sale
    {
        return new Sale(
            $this->identity,
            $this->productId,
            $this->employeeId,
            $this->customerId,
            $this->salePrice,
            $this->date
        );
    }
}
