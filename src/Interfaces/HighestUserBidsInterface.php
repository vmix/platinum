<?php
declare(strict_types=1);

namespace Ocelot\Platinum\Interfaces;

interface HighestUserBidsInterface
{
    public static function highestUserBids(?array $bidders): array ;
}
