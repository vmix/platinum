<?php
declare(strict_types=1);

namespace Ocelot\Platinum\Model;

class Bidder
{
    /**
     * @param string $name
     * @param array|null $bids
     */
    public function __construct(
        private string $name,
        private array|null $bids
    ) {
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return array|null
     */
    public function getBids(): ?array
    {
        return $this->bids;
    }

    /**
     * @param array|null $bids
     */
    public function setBids(?array $bids): void
    {
        $this->bids = $bids;
    }

}
