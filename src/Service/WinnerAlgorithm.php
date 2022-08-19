<?php

namespace Ocelot\Platinum\Service;

use Ocelot\Platinum\Data\MessagesStorage;
use Ocelot\Platinum\Interfaces\WinnerAlgorithmInterface;
use Ocelot\Platinum\Repository\BidderRepository;

class WinnerAlgorithm implements WinnerAlgorithmInterface
{
    public function findWinner(array $bidders, int $reservedPrice): ?array
    {
//        $bidders = $bidderRepository->allAuctionParticipants();

        try {
            $highestUserBids = HighestUserBids::highestUserBids($bidders);
            $winnerName = WinnerService::winnerName($highestUserBids);

            if (null === $winnerName) {
                throw new \Exception(MessagesStorage::EXCEPTION_NONE_WINNERS);
            }

            $winnerPrice = WinnerService::winnerPrice($bidders , $winnerName);

            if ($winnerName && $winnerPrice) {
                if ($winnerPrice - $reservedPrice > 0) {
                    echo sprintf(MessagesStorage::WINNER_WITH_WINNER_PRICE, $winnerName, $winnerPrice);
                } else {
                    echo sprintf(MessagesStorage::WINNER_WITH_RESERVE_PRICE, $winnerName, $reservedPrice);
                }
                return [$winnerName, $winnerPrice];
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        return null;
    }
}
