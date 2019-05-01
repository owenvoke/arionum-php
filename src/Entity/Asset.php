<?php

namespace pxgamer\Arionum\Entity;

final class Asset
{
    /** @var int */
    private $maxSupply;
    /** @var bool */
    private $tradable;
    /** @var float */
    private $price;
    /** @var bool */
    private $dividendOnly;
    /** @var bool */
    private $autoDivident;
    /** @var bool */
    private $allowBid;

    public function __construct(
        int $maxSupply,
        float $price,
        bool $isTradable,
        bool $dividendOnly,
        bool $autoDivident,
        bool $allowBid
    ) {
        $this->maxSupply = $maxSupply;
        $this->price = $price;
        $this->tradable = $isTradable;
        $this->dividendOnly = $dividendOnly;
        $this->autoDivident = $autoDivident;
        $this->allowBid = $allowBid;
    }

    public function getMaxSupply(): int
    {
        return $this->maxSupply;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function isAutoDivident(): bool
    {
        return $this->autoDivident;
    }

    public function isAllowingBids(): bool
    {
        return $this->allowBid;
    }

    public function isDividendOnly(): bool
    {
        return $this->dividendOnly;
    }

    public function isTradable(): bool
    {
        return $this->tradable;
    }

    public function toArray(): array
    {
        return [
            $this->getMaxSupply(),
            (int)$this->isTradable(),
            number_format($this->getPrice(), 8, '.', ''),
            (int)$this->isDividendOnly(),
            (int)$this->isAutoDivident(),
            (int)$this->isAllowingBids(),
        ];
    }

    public function __toString(): string
    {
        return (string)json_encode($this->toArray());
    }
}
