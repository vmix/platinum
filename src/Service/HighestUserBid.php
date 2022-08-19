<?php

namespace Ocelot\Platinum\Service;

use Ocelot\Platinum\Interfaces\HighestUserBidInterface;
use Ocelot\Platinum\Model\Bidder;

class HighestUserBid implements HighestUserBidInterface
{

    public static function findHighestUserBid(Bidder $bidder): ?int
    {
        if(null === $bidder->getBids()) {
            return null;
        }

        $allUserBids = $bidder->getBids();
        sort($allUserBids);

        return array_pop($allUserBids);
    }
}
