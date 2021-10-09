<?php

namespace Shopph\Customer\Application\Query;

use Shopph\Contract\Customer\Application\Query\GetCustomersHandlerInterface;
use Shopph\Contract\Customer\Domain\Model\CustomerFinderInterface;

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
