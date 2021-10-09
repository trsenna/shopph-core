<?php

namespace Shopph\Customer\Application\Command;

use Shopph\Contract\Customer\Application\Command\StoreCustomerHandlerInterface;
use Shopph\Contract\Customer\Domain\Model\CustomerFactoryInterface;
use Shopph\Contract\Customer\Domain\Model\CustomerRepositoryInterface;
use Shopph\Contract\Shared\Event\DispatcherInterface;
use Shopph\Customer\Application\Event\StoredCustomer;

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
