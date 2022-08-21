<?php
declare(strict_types=1);

use Ocelot\Platinum\Data\ReservedPrice;
use Ocelot\Platinum\Model\Bidder;
use Ocelot\Platinum\Service\WinnerAlgorithm;
use PHPUnit\Framework\TestCase;

class WinnerAlgorithmTest extends TestCase
{
    /**
     * @dataProvider biddersProvider
     */
    public function testFindWinner($bidders, $reservePrice, $expected)
    {
        $algorithm = new WinnerAlgorithm();
        $result = $algorithm->findWinner($bidders, $reservePrice);

        $this->assertSame($expected, $result);

    }

    public function biddersProvider(): Generator
    {
        yield 'technical_task' => [[
                $bidderA = new Bidder('Bidder-A', [110, 130]),
                $bidderB = new Bidder('Bidder-B', null),
                $bidderC = new Bidder('Bidder-C', [125]),
                $bidderD = new Bidder('Bidder-D', [105, 115, 90]),
                $bidderE = new Bidder('Bidder-E', [132, 135, 140]),
            ], ReservedPrice::getReservedPrice(), ['Bidder-E', 130]];
        yield 'one_bidder_null_bids' => [[
                $bidderB = new Bidder('Bidder-B', null),
            ], ReservedPrice::getReservedPrice(), null];
        yield 'one_bidder_winning_bids' => [[
                $bidderA = new Bidder('Bidder-A', [110, 130]),
            ], ReservedPrice::getReservedPrice(), ['Bidder-A', 100]];
        yield 'one_bidder_below_reserve_price' => [[
                $bidderA = new Bidder('Bidder-A', [99]),
            ], ReservedPrice::getReservedPrice(), null];
        yield 'two_bidders_one_doesnt_bid' => [[
                $bidderA = new Bidder('Bidder-A', [99]),
                $bidderB = new Bidder('Bidder-B', null),
            ], ReservedPrice::getReservedPrice(), null];
        yield 'two_bidders_all_below_reserve_price' => [[
                $bidderA = new Bidder('Bidder-A', [99]),
                $bidderB = new Bidder('Bidder-C', [98]),
            ], ReservedPrice::getReservedPrice(), null];
        yield 'two_bidders_one_above_reserve_price' => [[
                $bidderA = new Bidder('Bidder-A', [101]),
                $bidderB = new Bidder('Bidder-B', null),
            ], ReservedPrice::getReservedPrice(), ['Bidder-A', 100]];
        yield 'two_bidders' => [[
                $bidderA = new Bidder('Bidder-A', [110]),
                $bidderB = new Bidder('Bidder-C', [125]),
            ], ReservedPrice::getReservedPrice(), ['Bidder-C', 110]];
        yield 'three_bidders' => [[
                $bidderA = new Bidder('Bidder-A', [110, 130]),
                $bidderB = new Bidder('Bidder-B', null),
                $bidderB = new Bidder('Bidder-C', [125]),
            ], ReservedPrice::getReservedPrice(), ['Bidder-A', 125]];
        yield 'three_bidders_one_null_one_below_reserve_price' => [[
                $bidderA = new Bidder('Bidder-A', [110, 130]),
                $bidderB = new Bidder('Bidder-B', null),
                $bidderB = new Bidder('Bidder-C', [90]),
            ], ReservedPrice::getReservedPrice(), ['Bidder-A', 100]];
        yield 'four and more_bidders' => [[
                $bidderA = new Bidder('Bidder-A', [110, 130]),
                $bidderB = new Bidder('Bidder-B', null),
                $bidderC = new Bidder('Bidder-C', [125]),
                $bidderD = new Bidder('Bidder-D', [105, 115, 90]),
            ], ReservedPrice::getReservedPrice(), ['Bidder-A', 125]];
    }
}
