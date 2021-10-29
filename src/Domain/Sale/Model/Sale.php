<?php

namespace Shopph\Domain\Sale\Model;

use Shopph\Shared\Contract\Model\IdentityInterface;
use Shopph\Shared\Model\AbstractEntity;

class Sale extends AbstractEntity
{
    private IdentityInterface $productId;
    private IdentityInterface $employeeId;
    private IdentityInterface $customerId;
    private SalePrice $price;
    private \DateTime $date;

    public function __construct(
        IdentityInterface $identity,
        IdentityInterface $productId,
        IdentityInterface $employeeId,
        IdentityInterface $customerId,
        SalePrice $price,
        \DateTime $date
    ) {
        parent::__construct($identity);

        $this->price = $price;
        $this->productId = $productId;
        $this->employeeId = $employeeId;
        $this->customerId = $customerId;
        $this->date = $date;
    }

    public function getProductId(): IdentityInterface
    {
        return $this->productId;
    }

    public function getEmployeeId(): IdentityInterface
    {
        return $this->employeeId;
    }

    public function getCustomerId(): IdentityInterface
    {
        return $this->customerId;
    }

    public function getPrice(): SalePrice
    {
        return $this->price;
    }

    public function getDate(): \DateTime
    {
        return $this->date;
    }
}
