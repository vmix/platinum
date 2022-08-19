<?php

use Ocelot\Platinum\Data\MessagesStorage;
use Ocelot\Platinum\Data\ReservedPrice;
use Ocelot\Platinum\Repository\BidderRepository;
use Ocelot\Platinum\Service\HighestUserBids;
use Ocelot\Platinum\Service\Message;
use Ocelot\Platinum\Service\WinnerService;

require_once 'vendor/autoload.php';

$reservedPrice = ReservedPrice::getReservedPrice();
$bidderRepository = new BidderRepository();
$bidders = $bidderRepository->allAuctionParticipants();

try {
    $highestUserBids = HighestUserBids::highestUserBids($bidders);
    $winnerName = WinnerService::winnerName($highestUserBids);
//    var_dump($highestUserBids);
    if (null === $winnerName) {
        throw new \Exception("<h1>Winner is not defined</h1>");
    }

    if (count($highestUserBids) == 1) {
        $key = array_key_first($highestUserBids);
        $winnerPrice = $highestUserBids[$key];
    } else {
        unset($highestUserBids[$winnerName]);

        $key = array_key_last($highestUserBids);
        $secondBetterPrice = $highestUserBids[$key];

        $highestLoosingBids = $highestUserBids;

        if ($reservedPrice > $secondBetterPrice) {
            $winnerPrice = $reservedPrice;
            echo sprintf(MessagesStorage::WINNER_WITH_RESERVE_PRICE, $winnerName, $winnerPrice);

            return true;
        } else {
            $winnerPrice = WinnerService::winnerPrice($highestLoosingBids , $winnerName);
        }
    }

    if ($winnerPrice - $reservedPrice >= 0) {
        if ($winnerName && $winnerPrice) {
            echo sprintf(MessagesStorage::WINNER_WITH_WINNER_PRICE, $winnerName, $winnerPrice);
            return true;
        }
    } else {
        print(MessagesStorage::BID_LESS_THAN_RESERVE_PRICE);
        return null;
    }
} catch (Exception $e) {
    echo $e->getMessage();
}

