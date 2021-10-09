<?php

namespace Shopph\Customer\Application\Query;

use Shopph\Contract\Customer\Application\Query\GetCustomerHandlerInterface;
use Shopph\Contract\Customer\Domain\Model\CustomerFinderInterface;

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
