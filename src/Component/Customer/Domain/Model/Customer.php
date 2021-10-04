<?php

namespace Shopph\Customer\Domain\Model;

use Shopph\Contract\Foundation\Model\IdentityInterface;
use Shopph\Shared\Foundation\Model\AbstractEntity;

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
