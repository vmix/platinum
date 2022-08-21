<?php
declare(strict_types=1);

namespace Ocelot\Platinum\Service;

use Ocelot\Platinum\Data\MessagesStorage;
use Ocelot\Platinum\Data\ReservedPrice;
use Ocelot\Platinum\Interfaces\WinnerInterface;

class WinnerService implements WinnerInterface
{
    public static function winnerName(array $highestUserBids): ?string
    {
        try {
            switch (count($highestUserBids)) {
                case 0:
                    throw new \Exception(MessagesStorage::EXCEPTION_NO_BIDS);
                case 1:
                    $key = array_key_last($highestUserBids);
                    $winnerBid = $highestUserBids[$key];

                    if ($winnerBid >= ReservedPrice::getReservedPrice()) {
                        return $key;
                    } else {
                        return null;
                    }
                default:
                    $twoLuckiestBidders = array_slice($highestUserBids, -2);
                    $potentialWinner = array_pop($highestUserBids);
                    $hisOpponent = array_pop($highestUserBids);

                    if($potentialWinner < ReservedPrice::getReservedPrice()) {
                        throw new \Exception(MessagesStorage::EXCEPTION_NONE_WINNERS);
                    }

                    if ($potentialWinner == $hisOpponent) {
                        throw new \Exception(MessagesStorage::EXCEPTION_LOTS_OF_WINNERS);
                    } else {
                        return array_key_last($twoLuckiestBidders);
                    }
            }
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }

        return null;
    }

    /**
     * @throws \Exception
     */
    public static function winnerPrice(array $allBidders, string $winnerName): ?int
    {
        $reservedPrice = ReservedPrice::getReservedPrice();
        $highestUserBids = HighestUserBids::highestUserBids($allBidders);

        if (count((array) $highestUserBids) == 0) {
            return null;
        }

        if (count((array) $highestUserBids) == 1) {
            return $reservedPrice;
        } else {
            unset($highestUserBids[$winnerName]);

            $key = array_key_last($highestUserBids);
            $secondBetterPrice = $highestUserBids[$key];

            $highestLoosingBids = $highestUserBids;

            if ($reservedPrice > $secondBetterPrice) {
                return $reservedPrice;
            } else {
                switch (count((array) $highestLoosingBids)) {
                    case 0:
                        return null;
                    case 1:
                        $key = array_key_first($highestLoosingBids);
                        return $highestLoosingBids[$key];
                    default:
                        unset($highestLoosingBids[$winnerName]);
                        return max($highestLoosingBids);
                }
            }
        }
    }
}
