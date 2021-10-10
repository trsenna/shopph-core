<?php

namespace Shopph\Domain\Contract\Model;

interface EmployeeFinderInterface
{
    public function findOne(string $id): \stdClass;
    public function findAll(): array;
}
