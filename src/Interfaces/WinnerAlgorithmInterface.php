<?php

namespace Ocelot\Platinum\Interfaces;

use Ocelot\Platinum\Repository\BidderRepository;

interface WinnerAlgorithmInterface
{
    public function findWinner(BidderRepository $bidderRepository, int $reservedPrice): ?bool ;
}
