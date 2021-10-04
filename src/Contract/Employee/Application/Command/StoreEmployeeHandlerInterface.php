<?php

namespace Shopph\Contract\Employee\Application\Command;

use Shopph\Employee\Application\Command\StoreEmployee;

interface StoreEmployeeHandlerInterface
{
    public function execute(StoreEmployee $command): void;
}
