<?php

namespace Ocelot\Platinum\Repository;

use Ocelot\Platinum\Model\Bidder;

class BidderRepository
{
    public function allAuctionParticipants(): ?array
    {
        $bidderA = new Bidder('Bidder-A', [100, 130]);
        $bidderB = new Bidder('Bidder-B', null);
        $bidderC = new Bidder('Bidder-C', [80]);
        $bidderD = new Bidder('Bidder-D', [105, 115, 125]);
        $bidderE = new Bidder('Bidder-E', [132, 135, 140]);
        $bidderF = new Bidder('Bidder-F', [99]);

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
            $bidderF,
        ];
    }

}
