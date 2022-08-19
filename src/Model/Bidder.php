<?php
declare(strict_types=1);

namespace Ocelot\Platinum\Model;

class Bidder
{
    public function __construct(
        private string $name,
        private array|null $bids
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getBids(): ?array
    {
        return $this->bids;
    }

    public function setBids(?array $bids): void
    {
        $this->bids = $bids;
    }

}
