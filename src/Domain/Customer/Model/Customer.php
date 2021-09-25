<?php

namespace Shopph\Domain\Customer\Model;

use Shopph\Contract\Foundation\Model\IdentityInterface;
use Shopph\Domain\Foundation\Model\AbstractEntity;

class Customer extends AbstractEntity
{
    private CustomerName $name;

    public function __construct(IdentityInterface $identity, CustomerName $name)
    {
        parent::__construct($identity);
        $this->name = $name;
    }

    public function getName(): CustomerName
    {
        return $this->name;
    }
}
