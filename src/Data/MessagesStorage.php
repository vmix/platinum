<?php

namespace Ocelot\Platinum\Data;

class MessagesStorage
{
    public const EXCEPTION_NO_BIDS = 'Participants did not make any bids, winner is not defined, please connect with our administration.';
    public const EXCEPTION_LOTS_OF_WINNERS = 'We two or more winners, please connect with our administration.';
    public const EXCEPTION_NONE_WINNERS = 'We have no winners, because all bidders placed their bids less than reserve price.';

    public const BID_LESS_THAN_RESERVE_PRICE = "<h1>The winner proposed the price less than the reserve price </h1>";
    public const WINNER_WITH_RESERVE_PRICE = '<h1>The winner become %s with RESERVE price %s euro </h1>';
    public const WINNER_WITH_WINNER_PRICE = '<h1>The winner become %s with winning price %s euro </h1>';

}