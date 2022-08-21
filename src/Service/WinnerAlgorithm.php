<?php

namespace Ocelot\Platinum\Service;

use Ocelot\Platinum\Data\MessagesStorage;
use Ocelot\Platinum\Interfaces\WinnerAlgorithmInterface;
use Ocelot\Platinum\Repository\BidderRepository;

class WinnerAlgorithm implements WinnerAlgorithmInterface
{
    public function findWinner(array $bidders, int $reservedPrice): ?array
    {
        try {
            $highestUserBids = HighestUserBids::highestUserBids($bidders);
            $winnerName = WinnerService::winnerName($highestUserBids);

            if (null === $winnerName) {
                throw new \Exception(MessagesStorage::EXCEPTION_NONE_WINNERS);
            }

            $winningPrice = WinnerService::winnerPrice($bidders , $winnerName);

            if ($winnerName && $winningPrice) {
                if ($winningPrice - $reservedPrice > 0) {
                    echo sprintf(MessagesStorage::WINNER_WITH_WINNING_PRICE, $winnerName, $winningPrice);
                } else {
                    echo sprintf(MessagesStorage::WINNER_WITH_RESERVE_PRICE, $winnerName, $reservedPrice);
                }
                return [$winnerName, $winningPrice];
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        return null;
    }
}
