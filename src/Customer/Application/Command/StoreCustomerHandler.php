<?php

namespace Shopph\Customer\Application\Command;

use Shopph\Customer\Application\Event\StoredCustomer;
use Shopph\Customer\Contract\Command\StoreCustomerHandlerInterface;
use Shopph\Customer\Contract\Model\CustomerFactoryInterface;
use Shopph\Customer\Contract\Model\CustomerRepositoryInterface;
use Shopph\Foundation\Contract\Event\DispatcherInterface;

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

    public function execute(StoreCustomer $command): void
    {
        $customer = $this->customerFactory->create($command->name);
        $this->customerRepository->add($customer);

        $this->dispatcher->dispatch(
            StoredCustomer::fromEntity($customer)
        );
    }
}
