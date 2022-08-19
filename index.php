<?php

use Ocelot\Platinum\Data\ReservedPrice;
use Ocelot\Platinum\Repository\BidderRepository;
use Ocelot\Platinum\Service\BiddingService;

require_once 'vendor/autoload.php';

$reservedPrice = ReservedPrice::getReservedPrice();
$bidderRepository = new BidderRepository();
$bidders = $bidderRepository->allAuctionParticipants();

try {
    $highestUserBids = BiddingService::highestUserBids($bidders);
    $winnerName = BiddingService::defineWinner($highestUserBids);
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
            echo "<h1>The winner become " . $winnerName . " with RESERVE price " . $reservedPrice . " euro </h1>";

            return true;
        } else {
            $winnerPrice = BiddingService::winnerPrice($highestLoosingBids , $winnerName);
        }
    }

    if ($winnerPrice - $reservedPrice > 0) {
        if ($winnerName && $winnerPrice) {
            echo "<h1>The winner become " . $winnerName . " with winner price " . $winnerPrice . " euro </h1>";
            return true;
        }
    } else {
        echo "<h1>The winner proposed the price less than the reserve price </h1>";
        return null;
    }
} catch (Exception $e) {
    echo $e->getMessage();
}

