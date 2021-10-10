<?php

namespace Shopph\Domain\Contract\Model;

interface ProductFinderInterface
{
    public function findOne(string $id): \stdClass;
    public function findAll(): array;
}
