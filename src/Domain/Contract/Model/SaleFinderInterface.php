<?php

namespace Shopph\Domain\Contract\Model;

interface SaleFinderInterface
{
    public function findOne(string $id): \stdClass;
    public function findAll(): array;
}
