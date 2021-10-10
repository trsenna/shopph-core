<?php

namespace Shopph\Domain\Customer\Model;

use Shopph\Shared\Contract\Model\IdentityInterface;
use Shopph\Shared\Model\AbstractEntity;

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
