<?php

namespace Shopph\Application\Contract\Command;

use Shopph\Application\Employee\Command\StoreEmployee;

interface StoreEmployeeHandlerInterface
{
    public function execute(StoreEmployee $command): void;
}
