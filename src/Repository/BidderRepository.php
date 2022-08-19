<?php
declare(strict_types=1);

namespace Ocelot\Platinum\Repository;

use Ocelot\Platinum\Model\Bidder;

class BidderRepository
{
    public function allAuctionParticipants(): ?array
    {
        $bidderA = new Bidder('Bidder-A', [110, 130]);
        $bidderB = new Bidder('Bidder-B', null);
        $bidderC = new Bidder('Bidder-C', [125]);
        $bidderD = new Bidder('Bidder-D', [105, 115, 90]);
        $bidderE = new Bidder('Bidder-E', [132, 135, 140]);


        return [
            $bidderA,
            $bidderB,
            $bidderC,
            $bidderD,
            $bidderE,
        ];
    }

}
