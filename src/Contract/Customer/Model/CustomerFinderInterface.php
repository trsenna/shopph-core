<?php

namespace Shopph\Contract\Customer\Model;

interface CustomerFinderInterface
{
    public function findOne(string $id): \stdClass;
    public function findAll(): array;
}
