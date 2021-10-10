<?php

namespace Shopph\Domain\Product\Model;

use Shopph\Shared\Contract\Model\IdentityInterface;
use Shopph\Shared\Model\AbstractEntity;

class Product extends AbstractEntity
{
    private string $name;
    private ProductPrice $price;

    public function __construct(IdentityInterface $identity, string $name, ProductPrice $price)
    {
        parent::__construct($identity);

        static::verify('name not blank', strlen(trim($name)) !== 0);

        $this->name = $name;
        $this->price = $price;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): ProductPrice
    {
        return $this->price;
    }
}
