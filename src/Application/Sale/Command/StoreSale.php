<?php

namespace Shopph\Application\Sale\Command;

final class StoreSale
{
    public string $productId;
    public string $employeeId;
    public string $customerId;
    public float $unitPrice;
    public int $quantity;
}
