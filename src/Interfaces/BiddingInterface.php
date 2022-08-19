<?php

namespace Ocelot\Platinum\Interfaces;

use Ocelot\Platinum\Model\Bidder;

interface BiddingInterface
{
    public static function findHighestUserBid(Bidder $bidder): int|null ;
}
