<?php

namespace Shopph\Contract\Customer\Domain\Model;

interface CustomerFinderInterface
{
    public function findOne(string $id): \stdClass;
    public function findAll(): array;
}
