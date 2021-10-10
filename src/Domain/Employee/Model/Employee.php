<?php

namespace Shopph\Domain\Employee\Model;

use Shopph\Shared\Contract\Model\IdentityInterface;
use Shopph\Shared\Model\AbstractEntity;

class Employee extends AbstractEntity
{
    private EmployeeName $name;

    public function __construct(IdentityInterface $identity, EmployeeName $name)
    {
        parent::__construct($identity);
        $this->name = $name;
    }

    public function getName(): EmployeeName
    {
        return $this->name;
    }
}
