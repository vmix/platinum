<?php
declare(strict_types=1);

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

    public function biddersProvider(): array
    {
        return [
            'technical_task' => [[
                $bidderA = new Bidder('Bidder-A', [110, 130]),
                $bidderB = new Bidder('Bidder-B', null),
                $bidderC = new Bidder('Bidder-C', [125]),
                $bidderD = new Bidder('Bidder-D', [105, 115, 90]),
                $bidderE = new Bidder('Bidder-E', [132, 135, 140]),
            ], 100, ['Bidder-E', 130]],
            'one_bidder_null_bids' => [[
                $bidderB = new Bidder('Bidder-B', null),
            ], 100, null],
            'one_bidder_winning_bids' => [[
                $bidderA = new Bidder('Bidder-A', [110, 130]),
            ], 100, ['Bidder-A', 100]],
            'one_bidder_below_reserve_price' => [[
                $bidderA = new Bidder('Bidder-A', [99]),
            ], 100, null],
            'two_bidders_one_doesnt_bid' => [[
                $bidderA = new Bidder('Bidder-A', [99]),
                $bidderB = new Bidder('Bidder-B', null),
            ], 100, null],
            'two_bidders_all_below_reserve_price' => [[
                $bidderA = new Bidder('Bidder-A', [99]),
                $bidderB = new Bidder('Bidder-C', [98]),
            ], 100, null],
            'two_bidders_one_above_reserve_price' => [[
                $bidderA = new Bidder('Bidder-A', [101]),
                $bidderB = new Bidder('Bidder-B', null),
            ], 100, ['Bidder-A', 100]],
            'two_bidders' => [[
                $bidderA = new Bidder('Bidder-A', [110]),
                $bidderB = new Bidder('Bidder-C', [125]),
            ], 100, ['Bidder-C', 110]],
            'three_bidders' => [[
                $bidderA = new Bidder('Bidder-A', [110, 130]),
                $bidderB = new Bidder('Bidder-B', null),
                $bidderB = new Bidder('Bidder-C', [125]),
            ], 100, ['Bidder-A', 125]],
            'three_bidders_one_null_one_below_reserve_price' => [[
                $bidderA = new Bidder('Bidder-A', [110, 130]),
                $bidderB = new Bidder('Bidder-B', null),
                $bidderB = new Bidder('Bidder-C', [90]),
            ], 100, ['Bidder-A', 100]],
            'four and more_bidders' => [[
                $bidderA = new Bidder('Bidder-A', [110, 130]),
                $bidderB = new Bidder('Bidder-B', null),
                $bidderC = new Bidder('Bidder-C', [125]),
                $bidderD = new Bidder('Bidder-D', [105, 115, 90]),
            ], 100, ['Bidder-A', 125]],
        ];
    }
}
