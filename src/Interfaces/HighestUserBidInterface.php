<?php
declare(strict_types=1);

namespace Ocelot\Platinum\Interfaces;

use Ocelot\Platinum\Model\Bidder;

interface HighestUserBidInterface
{
    public static function findHighestUserBid(Bidder $bidder): ?int ;
}
