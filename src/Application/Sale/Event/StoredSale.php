<?php

namespace Shopph\Application\Sale\Event;

use Shopph\Domain\Sale\Model\Sale;
use Shopph\Shared\Contract\Event\EventInterface;

final class StoredSale implements EventInterface
{
    public string $id;
    public string $productId;
    public string $employeeId;
    public string $customerId;
    public float $price;
    public \DateTime $date;

    public static function fromEntity(Sale $sale): StoredSale
    {
        $event = new static();
        $event->id = $sale->getIdentity()->value();
        $event->productId = $sale->getProductId()->value();
        $event->employeeId = $sale->getEmployeeId()->value();
        $event->customerId = $sale->getCustomerId()->value();
        $event->price = $sale->getPrice()->getValue();
        $event->date = $sale->getDate();

        return $event;
    }
}
