<?php
declare(strict_types=1);

namespace Ocelot\Platinum\Repository;

use Ocelot\Platinum\Model\Bidder;

class BidderRepository
{
    public function allAuctionParticipants(): ?array
    {
//        $bidderB = new Bidder('Bidder-B', null);
//        $bidderA = new Bidder('Bidder-A', [100, 130]);
//        $bidderC = new Bidder('Bidder-C', [80]);
//        $bidderD = new Bidder('Bidder-D', [105, 115, 125]);
//        $bidderE = new Bidder('Bidder-E', [132, 135, 140]);
//        $bidderF = new Bidder('Bidder-F', [99]);

//        $bidderB = new Bidder('bidderB', null);
//        $bidderA = new Bidder('bidderA', null);
//        $bidderC = new Bidder('bidderC', null);
//        $bidderD = new Bidder('bidderD', null);
//        $bidderE = new Bidder('bidderE', null);

        $bidderB = new Bidder('Bidder-B', null);
        $bidderA = new Bidder('Bidder-A', [101]);
        $bidderC = new Bidder('Bidder-C', [102]);
//        $bidderD = new Bidder('Bidder-D', [99]);
//        $bidderE = new Bidder('Bidder-E', [99]);
//        $bidderF = new Bidder('Bidder-F', [99]);

        return [
            $bidderB,
            $bidderA,
            $bidderC,
//            $bidderD,
//            $bidderE,
//            $bidderF,
        ];
    }

}
