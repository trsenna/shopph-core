<?php

namespace Shopph\Contract\Employee\Domain\Model;

interface EmployeeFinderInterface
{
    public function findOne(string $id): \stdClass;
    public function findAll(): array;
}
