<?php

namespace Shopph\Application\Customer\Command;

use Shopph\Application\Customer\Event\StoredCustomer;
use Shopph\Contract\Customer\Command\StoreCustomerHandlerInterface;
use Shopph\Contract\Customer\Model\CustomerFactoryInterface;
use Shopph\Contract\Customer\Model\CustomerRepositoryInterface;
use Shopph\Contract\Foundation\Event\DispatcherInterface;

final class StoreCustomerHandler implements StoreCustomerHandlerInterface
{
    private CustomerFactoryInterface $customerFactory;
    private CustomerRepositoryInterface $customerRepository;
    private DispatcherInterface $dispatcher;

    public function __construct(
        CustomerFactoryInterface $customerFactory,
        CustomerRepositoryInterface $customerRepository,
        DispatcherInterface $dispatcher
    ) {
        $this->customerFactory = $customerFactory;
        $this->customerRepository = $customerRepository;
        $this->dispatcher = $dispatcher;
    }

    public function execute(StoreCustomer $command): StoreCustomerResponse
    {
        $customer = $this->customerFactory->create($command->name);
        $this->customerRepository->add($customer);

        $this->dispatcher->dispatch(
            StoredCustomer::fromEntity($customer)
        );

        return StoreCustomerResponse::fromEntity($customer);
    }
}
