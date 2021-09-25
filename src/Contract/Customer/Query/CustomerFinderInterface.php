<?php

namespace Shopph\Contract\Customer\Query;

interface CustomerFinderInterface
{
    public function findOne(string $id): \stdClass;
    public function findAll(): array;
}
