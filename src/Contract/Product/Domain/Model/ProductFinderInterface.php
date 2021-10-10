<?php

namespace Shopph\Contract\Product\Domain\Model;

interface ProductFinderInterface
{
    public function findOne(string $id): \stdClass;
    public function findAll(): array;
}
