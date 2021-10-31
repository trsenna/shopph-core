<?php

namespace Shopph\Application\Product\Event;

use Shopph\Domain\Product\Model\Product;
use Shopph\Shared\Contract\Event\EventInterface;

final class StoredProduct implements EventInterface
{
    public string $id;
    public string $name;
    public float $price;

    public static function fromEntity(Product $product): StoredProduct
    {
        $event = new static();
        $event->id = $product->getIdentity()->value();
        $event->name = $product->getName();
        $event->price = $product->getPrice()->getValue();

        return $event;
    }
}
