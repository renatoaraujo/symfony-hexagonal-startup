<?php
declare(strict_types=1);

namespace App\Tests\Domain;

use App\Domain\Exception\ZeroOrNegativePriceException;
use App\Domain\Price;
use Faker\Generator;
use PHPUnit\Framework\TestCase;
use Faker;

final class PriceTest extends TestCase
{
    private Generator $generator;

    public function setUp(): void
    {
        $this->generator = Faker\Factory::create();
    }

    public function testItCanConstructPriceFromFloat(): void
    {
        $priceFloat = $this->generator->randomFloat(2, $min = 0.1);
        $price = Price::fromFloat($priceFloat);
        $this->assertEquals($priceFloat, $price->toFloat());
        $this->assertEquals((string)$priceFloat, $price->__toString());
    }

    public function testItCantConstructZeroOrNegativePrice(): void
    {
        $priceFloat = $this->generator->randomFloat(2, null, 0);

        $this->expectException(ZeroOrNegativePriceException::class);
        Price::fromFloat($priceFloat);
    }
}
