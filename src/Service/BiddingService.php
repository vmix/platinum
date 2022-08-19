<?php

namespace Ocelot\Platinum\Service;

use Ocelot\Platinum\Data\ExceptionMessage;
use Ocelot\Platinum\Data\ReservedPrice;
use Ocelot\Platinum\Interfaces\BiddingInterface;
use Ocelot\Platinum\Model\Bidder;

class BiddingService implements BiddingInterface
{
//    public function __construct(ExceptionMessage $exceptionMessage)
//    {
//    }

    public static function findHighestUserBid(Bidder $bidder): int|null
    {
        if(null === $bidder->getBids()) {
            return null;
        }

        $allUserBids = $bidder->getBids();
        sort($allUserBids);

        return array_pop($allUserBids);
    }

    /**
     * @throws \Exception
     */
    public static function highestUserBids(?array $bidders): array
    {
        if (count($bidders) == 0) {
            throw new \Exception(ExceptionMessage::EXCEPTION_NO_BIDS);
        }

        $highestUserBids = [];
        foreach ($bidders as $bidder) {
            if (null === self::findHighestUserBid($bidder)) continue;
//            if (self::findHighestUserBid($bidder) - ReservedPrice::getReservedPrice() < 0) continue;
            $highestUserBids[$bidder->getName()] = self::findHighestUserBid($bidder);
        }

        uasort($highestUserBids, 'self::compare');

        return $highestUserBids;
    }

    public static function defineWinner(array $highestUserBids): ?string
    {
        try {
            switch (count($highestUserBids)) {
                case 0:
                    throw new \Exception(ExceptionMessage::EXCEPTION_NO_BIDS);
                case 1:
                    return array_key_last($highestUserBids);
                default:
                    $twoLuckiestBidders = array_slice($highestUserBids, -2);
                    $potentialWinner = array_pop($highestUserBids);
                    $hisOpponent = array_pop($highestUserBids);

                    if($potentialWinner < ReservedPrice::getReservedPrice()) {
                        throw new \Exception(ExceptionMessage::EXCEPTION_NONE_WINNERS);
                    }

                    if ($potentialWinner == $hisOpponent) {
                        throw new \Exception(ExceptionMessage::EXCEPTION_LOTS_OF_WINNERS);
                    } else {
                        return array_key_last($twoLuckiestBidders);
                    }
            }
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }

        return null;
    }

    public static function winnerPrice(array $allBidders, string $winnerName): ?int
    {
        switch (count($allBidders)) {
            case 0:
                return null;
            case 1:
                $key = array_key_first($allBidders);
                return($allBidders[$key]);
            default:
                unset($allBidders[$winnerName]);
                return max($allBidders);
        }
    }

    private static function compare($a, $b): int
    {
        if ($a == $b) {
            return 0;
        }
        return ($a < $b) ? -1 : 1;
    }
}
