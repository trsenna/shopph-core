<?php

namespace Shopph\Tests\Domain\Sale\Model;

use PHPUnit\Framework\TestCase;
use Shopph\Domain\Contract\Model\SaleFactoryInterface;
use Shopph\Domain\Customer\Model\Customer;
use Shopph\Domain\Employee\Model\Employee;
use Shopph\Domain\Product\Model\Product;
use Shopph\Domain\Sale\Model\Sale;
use Shopph\Domain\Sale\Model\SaleFactory;
use Shopph\Domain\Sale\Model\SalePrice;
use Shopph\Shared\Contract\Model\IdentityFactoryInterface;
use Shopph\Tests\Shared\Faker\IdentityFakerTrait;

final class SaleFactoryTest extends TestCase
{
    use IdentityFakerTrait;

    private ?IdentityFactoryInterface $identityFactory;
    private ?SaleFactoryInterface $saleFactory;

    private ?Product $product;
    private ?Employee $employee;
    private ?Customer $customer;
    private ?SalePrice $price;

    public function setUp(): void
    {
        /** @var MockObject $identityFactoryMock */
        $identityFactoryMock = $this->createMock(IdentityFactoryInterface::class);
        $identityFactoryMock->method('create')->willReturn(
            $this->fakeIdentity('87ffd646-9ef8-473b-951c-28f53fe8cadc')
        );

        $this->identityFactory = $identityFactoryMock;
        $this->saleFactory = new SaleFactory($this->identityFactory);

        $productMock = $this->createMock(Product::class);
        $productMock->method('getIdentity')->willReturn(
            $this->fakeIdentity('1922c9dc-1869-4b69-bfc2-b10ee355e4ff')
        );

        $productMock = $this->createMock(Product::class);
        $productMock->method('getIdentity')->willReturn(
            $this->fakeIdentity('1922c9dc-1869-4b69-bfc2-b10ee355e4ff')
        );

        $employeeMock = $this->createMock(Employee::class);
        $employeeMock->method('getIdentity')->willReturn(
            $this->fakeIdentity('4837bd58-9b75-4dc2-b881-2f72947fb123')
        );

        $customerMock = $this->createMock(Customer::class);
        $customerMock->method('getIdentity')->willReturn(
            $this->fakeIdentity('263d3f42-9057-420e-ae06-ed0c805026a9')
        );

        $this->product = $productMock;
        $this->employee = $employeeMock;
        $this->customer = $customerMock;
        $this->price = new SalePrice(5, 2);
    }

    public function testCreateWhenCalledMustReturnSale(): void
    {
        $sale = $this->createSale();

        $this->assertNotNull($sale);
        $this->assertInstanceOf(Sale::class, $sale);
    }

    public function testCreateWhenCalledMustReturnSaleWithIdentity(): void
    {
        $sale = $this->createSale();
        $saleIdentity = $sale->getIdentity();

        $this->assertNotNull($sale->getIdentity());
        $this->assertEquals('87ffd646-9ef8-473b-951c-28f53fe8cadc', $saleIdentity->value());
    }

    public function testCreateWhenCalledMustReturnSaleWithProductId(): void
    {
        $sale = $this->createSale();
        $productId = $sale->getProductId();

        $this->assertNotNull($productId);
        $this->assertSame($this->product->getIdentity(), $productId);
    }

    public function testCreateWhenCalledMustReturnSaleWithEmployeeId(): void
    {
        $sale = $this->createSale();
        $employeeId = $sale->getEmployeeId();

        $this->assertNotNull($employeeId);
        $this->assertSame($this->employee->getIdentity(), $employeeId);
    }

    public function testCreateWhenCalledMustReturnSaleWithCustomerId(): void
    {
        $sale = $this->createSale();
        $customerId = $sale->getCustomerId();

        $this->assertNotNull($customerId);
        $this->assertSame($this->customer->getIdentity(), $customerId);
    }

    public function testCreateWhenCalledMustReturnSaleWithPrice(): void
    {
        $sale = $this->createSale();
        $salePrice = $sale->getPrice();

        $this->assertNotNull($salePrice);
        $this->assertSame($this->price, $salePrice);
    }

    private function createSale(): Sale
    {
        return $this->saleFactory->create(
            $this->product,
            $this->employee,
            $this->customer,
            $this->price
        );
    }
}
