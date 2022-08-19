<?php

namespace Ocelot\Platinum\Interfaces;

use Ocelot\Platinum\Repository\BidderRepository;

interface WinnerAlgorithmInterface
{
    public function findWinner(array $bidders, int $reservedPrice): ?array ;
}
