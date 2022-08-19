<?php

namespace Ocelot\Platinum\Service;

use Ocelot\Platinum\Data\MessagesStorage;
use Ocelot\Platinum\Interfaces\HighestUserBidsInterface;
use Ocelot\Platinum\Service\HighestUserBid;

class HighestUserBids implements HighestUserBidsInterface
{

    /**
     * @throws \Exception
     */
    public static function highestUserBids(?array $bidders): array
    {
        if (count($bidders) == 0) {
            throw new \Exception(MessagesStorage::EXCEPTION_NO_BIDS);
        }

        $highestUserBids = [];
        foreach ($bidders as $bidder) {
            if (null === HighestUserBid::findHighestUserBid($bidder)) continue;
            $highestUserBids[$bidder->getName()] = HighestUserBid::findHighestUserBid($bidder);
        }

        uasort($highestUserBids, 'self::compare');

        return $highestUserBids;
    }

    private static function compare($a, $b): int
    {
        if ($a == $b) {
            return 0;
        }
        return ($a < $b) ? -1 : 1;
    }
}
