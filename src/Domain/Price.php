<?php
declare(strict_types=1);

namespace App\Domain;

use App\Domain\Exception\ZeroOrNegativePriceException;

final class Price
{
    private float $price;

    private function __construct()
    {
    }

    public static function fromFloat(float $price): Price
    {
        if (0 >= $price) {
            throw new ZeroOrNegativePriceException();
        }

        $priceInstance = new self();
        $priceInstance->price = $price;
        return $priceInstance;
    }

    public function toFloat(): float
    {
        return $this->price;
    }

    public function __toString()
    {
        return (string) $this->price;
    }
}
