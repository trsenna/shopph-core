<?php

namespace Shopph\Application\Customer\Query;

use Shopph\Application\Contract\Query\GetCustomerHandlerInterface;
use Shopph\Domain\Contract\Model\CustomerFinderInterface;

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
