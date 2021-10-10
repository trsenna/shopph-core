<?php

namespace Shopph\Application\Customer\Query;

use Shopph\Application\Contract\Query\GetCustomersHandlerInterface;
use Shopph\Domain\Contract\Model\CustomerFinderInterface;

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
