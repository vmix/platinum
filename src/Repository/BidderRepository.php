<?php

namespace Ocelot\Platinum\Repository;

use Ocelot\Platinum\Model\Bidder;

class BidderRepository
{
    public function allAuctionParticipants(): ?array
    {
        $bidderA = new Bidder('Bidder-A', [99 ]);
        $bidderB = new Bidder('Bidder-B', null);
        $bidderC = new Bidder('Bidder-C', [99]);
        $bidderD = new Bidder('Bidder-D', [99, 99]);
        $bidderE = new Bidder('Bidder-E', [99]);

//        $bidderA = new Bidder('bidderA', null);
//        $bidderB = new Bidder('bidderB', null);
//        $bidderC = new Bidder('bidderC', null);
//        $bidderD = new Bidder('bidderD', null);
//        $bidderE = new Bidder('bidderE', null);

        return [
            $bidderA,
            $bidderB,
            $bidderC,
            $bidderD,
            $bidderE,
        ];
    }

}
