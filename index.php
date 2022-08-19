<?php

use Ocelot\Platinum\Data\MessagesStorage;
use Ocelot\Platinum\Data\ReservedPrice;
use Ocelot\Platinum\Repository\BidderRepository;
use Ocelot\Platinum\Service\HighestUserBids;
use Ocelot\Platinum\Service\WinnerAlgorithm;
use Ocelot\Platinum\Service\WinnerService;

require_once 'vendor/autoload.php';

$bidderRepository = new BidderRepository();
$reservePrice = ReservedPrice::getReservedPrice();

$algorithm = new WinnerAlgorithm();
$algorithm->findWinner($bidderRepository, $reservePrice);
//$reservedPrice = ReservedPrice::getReservedPrice();

//$bidderRepository = new BidderRepository();
//$bidders = $bidderRepository->allAuctionParticipants();
//
//try {
//    $highestUserBids = HighestUserBids::highestUserBids($bidders);
//    $winnerName = WinnerService::winnerName($highestUserBids);
//
//    if (null === $winnerName) {
//        throw new \Exception(MessagesStorage::EXCEPTION_WINNER_NOT_DEFINED);
//    }
//
//    $winnerPrice = WinnerService::winnerPrice($bidders , $winnerName);
////    var_dump($bidders, $winnerName, $winnerPrice);die;
//
////    if ($winnerPrice - $reservedPrice > 0) {
//    if ($winnerName && $winnerPrice) {
//        if ($winnerPrice - $reservedPrice > 0) {
//                echo sprintf(MessagesStorage::WINNER_WITH_WINNER_PRICE, $winnerName, $winnerPrice);
//        }
//            else {
//                echo sprintf(MessagesStorage::WINNER_WITH_RESERVE_PRICE, $winnerName, $reservedPrice);
////                print(MessagesStorage::BID_LESS_THAN_RESERVE_PRICE);
//            }
//        return true;
////            echo sprintf(MessagesStorage::WINNER_WITH_WINNER_PRICE, $winnerName, $winnerPrice);
////            return true;
//    } else {
//        return null;
//    }
////    } else {
////        echo sprintf(MessagesStorage::WINNER_WITH_RESERVE_PRICE, $winnerName, $reservedPrice);
////        return true;
////    }
//} catch (Exception $e) {
//    echo $e->getMessage();
//}

