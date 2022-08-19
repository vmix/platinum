<?php

namespace Ocelot\Platinum\Interfaces;

interface HighestUserBidsInterface
{
    public static function highestUserBids(?array $bidders): array ;
}
