<?php

namespace Shopph\Domain\Contract\Model;

interface CustomerFinderInterface
{
    public function findOne(string $id): \stdClass;
    public function findAll(): array;
}
