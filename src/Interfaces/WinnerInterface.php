<?php

namespace Ocelot\Platinum\Interfaces;

use Ocelot\Platinum\Model\Bidder;

interface WinnerInterface
{
    public static function winnerName(array $highestUserBids): ?string ;

    public static function winnerPrice(array $allBidders, string $winnerName): ?int ;

}
