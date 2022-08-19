<?php

namespace Ocelot\Platinum\Data;

class ExceptionMessage
{
    public const EXCEPTION_NO_BIDS = 'Participants did not make any bids, winner is not defined, please connect with our administration.';
    public const EXCEPTION_LOTS_OF_WINNERS = 'We two or more winners, please connect with our administration.';
    public const EXCEPTION_NONE_WINNERS = 'We have no winners, because all bidders placed their bids less than reserve price.';

}
