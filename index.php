<?php
declare(strict_types=1);

use Ocelot\Platinum\Data\ReservedPrice;
use Ocelot\Platinum\Repository\BidderRepository;
use Ocelot\Platinum\Service\WinnerAlgorithm;

require_once 'vendor/autoload.php';

$bidders = (new BidderRepository())->allAuctionParticipants();
//var_dump($bidders);
$algorithm = new WinnerAlgorithm();
$algorithm->findWinner($bidders, ReservedPrice::getReservedPrice());


