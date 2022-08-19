<?php
declare(strict_types=1);

namespace Ocelot\Platinum\Service;

use Ocelot\Platinum\Data\MessagesStorage;
use Ocelot\Platinum\Data\ReservedPrice;
use Ocelot\Platinum\Interfaces\WinnerInterface;
use Ocelot\Platinum\Model\Bidder;

class WinnerService implements WinnerInterface
{
    public static function winnerName(array $highestUserBids): ?string
    {
        try {
            switch (count($highestUserBids)) {
                case 0:
                    throw new \Exception(MessagesStorage::EXCEPTION_NO_BIDS);
                case 1:
                    return array_key_last($highestUserBids);
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
}
