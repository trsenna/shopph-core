<?php

namespace Shopph\Customer\Application\Query;

use Shopph\Customer\Contract\Model\CustomerFinderInterface;
use Shopph\Customer\Contract\Query\GetCustomersHandlerInterface;

final class GetCustomersHandler implements GetCustomersHandlerInterface
{
    private CustomerFinderInterface $customerFinder;

    public function __construct(CustomerFinderInterface $customerFinder)
    {
        $this->customerFinder = $customerFinder;
    }

    public function execute(GetCustomers $query): GetCustomersResponse
    {
        return GetCustomersResponse::fromArray(
            $this->customerFinder->findAll()
        );
    }
}
