<?php
declare(strict_types=1);

namespace Ocelot\Platinum\Data;

final class ReservedPrice
{
    private const RESERVED_PRICE = 100;

    public static function getReservedPrice(): int
    {
        return self::RESERVED_PRICE;
    }
}
