<?php

namespace Shopph\Customer\Application\Query;

use Shopph\Customer\Contract\Model\CustomerFinderInterface;
use Shopph\Customer\Contract\Query\GetCustomerHandlerInterface;

final class GetCustomerHandler implements GetCustomerHandlerInterface
{
    private CustomerFinderInterface $customerFinder;

    public function __construct(CustomerFinderInterface $customerFinder)
    {
        $this->customerFinder = $customerFinder;
    }

    public function execute(GetCustomer $query): GetCustomerResponse
    {
        return GetCustomerResponse::fromObject(
            $this->customerFinder->findOne($query->id)
        );
    }
}
