<?php
declare(strict_types=1);

use Ocelot\Platinum\Data\ReservedPrice;
use Ocelot\Platinum\Repository\BidderRepository;
use Ocelot\Platinum\Service\WinnerAlgorithm;

require_once 'vendor/autoload.php';

$bidderRepository = new BidderRepository();
$reservePrice = ReservedPrice::getReservedPrice();

$algorithm = new WinnerAlgorithm();
$algorithm->findWinner($bidderRepository, $reservePrice);


