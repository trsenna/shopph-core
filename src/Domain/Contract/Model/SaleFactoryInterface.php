<?php

namespace Shopph\Domain\Contract\Model;

use Shopph\Domain\Customer\Model\Customer;
use Shopph\Domain\Employee\Model\Employee;
use Shopph\Domain\Product\Model\Product;
use Shopph\Domain\Sale\Model\Sale;
use Shopph\Domain\Sale\Model\SalePrice;

interface SaleFactoryInterface
{
    public function create(Product $product, Employee $employee, Customer $customer, SalePrice $price): Sale;
}
