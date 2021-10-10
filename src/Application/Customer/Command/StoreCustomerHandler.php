<?php

namespace Shopph\Application\Customer\Command;

use Shopph\Application\Contract\Command\StoreCustomerHandlerInterface;
use Shopph\Application\Customer\Event\StoredCustomer;
use Shopph\Domain\Contract\Model\CustomerFactoryInterface;
use Shopph\Domain\Contract\Model\CustomerRepositoryInterface;
use Shopph\Shared\Contract\Event\DispatcherInterface;

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
