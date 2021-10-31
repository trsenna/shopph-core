<?php

namespace Shopph\Application\Sale\Command;

use Shopph\Application\Contract\Command\StoreSaleHandlerInterface;
use Shopph\Application\Sale\Event\StoredSale;
use Shopph\Domain\Contract\Model\CustomerRepositoryInterface;
use Shopph\Domain\Contract\Model\EmployeeRepositoryInterface;
use Shopph\Domain\Contract\Model\ProductRepositoryInterface;
use Shopph\Domain\Contract\Model\SaleFactoryInterface;
use Shopph\Domain\Contract\Model\SaleRepositoryInterface;
use Shopph\Domain\Sale\Model\SalePrice;
use Shopph\Shared\Contract\Event\DispatcherInterface;
use Shopph\Shared\Contract\Model\IdentityFactoryInterface;
use Shopph\Shared\Verification\VerifyTrait;

final class StoreSaleHandler implements StoreSaleHandlerInterface
{
    use VerifyTrait;

    private ProductRepositoryInterface $productRepository;
    private EmployeeRepositoryInterface $employeeRepository;
    private CustomerRepositoryInterface $customerRepository;
    private SaleRepositoryInterface $saleRepository;
    private IdentityFactoryInterface $identityFactory;
    private SaleFactoryInterface $saleFactory;
    private DispatcherInterface $dispatcher;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        EmployeeRepositoryInterface $employeeRepository,
        CustomerRepositoryInterface $customerRepository,
        SaleRepositoryInterface $saleRepository,
        IdentityFactoryInterface $identityFactory,
        SaleFactoryInterface $saleFactory,
        DispatcherInterface $dispatcher
    ) {
        $this->productRepository = $productRepository;
        $this->employeeRepository = $employeeRepository;
        $this->customerRepository = $customerRepository;
        $this->saleRepository = $saleRepository;
        $this->identityFactory = $identityFactory;
        $this->saleFactory = $saleFactory;
        $this->dispatcher = $dispatcher;
    }

    public function execute(StoreSale $command): void
    {
        $productIdentity = $this->identityFactory->valueOf($command->productId);
        $employeeIdentity = $this->identityFactory->valueOf($command->employeeId);
        $customerIdentity = $this->identityFactory->valueOf($command->customerId);

        $product = $this->productRepository->ofIdentity($productIdentity);
        $employee = $this->employeeRepository->ofIdentity($employeeIdentity);
        $customer = $this->customerRepository->ofIdentity($customerIdentity);

        static::verify('no product found', !is_null($product));
        static::verify('no employee found', !is_null($employee));
        static::verify('no customer found', !is_null($customer));

        $salePrice = new SalePrice($command->unitPrice, $command->quantity);

        $sale = $this->saleFactory->create($product, $employee, $customer, $salePrice);
        $this->saleRepository->add($sale);

        $storedSaleEvent = StoredSale::fromEntity($sale);
        $this->dispatcher->dispatch($storedSaleEvent);
    }
}
