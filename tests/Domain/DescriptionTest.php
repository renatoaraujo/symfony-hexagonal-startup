<?php
declare(strict_types=1);

namespace App\Tests\Domain;

use App\Domain\Description;
use App\Domain\Exception\InvalidDescriptionLengthException;
use Faker\Generator;
use PHPUnit\Framework\TestCase;
use Faker;

final class DescriptionTest extends TestCase
{
    private Generator $generator;

    public function setUp(): void
    {
        $this->generator = Faker\Factory::create();
    }

    public function testItCanConstructDescription(): void
    {
        $descriptionText = $this->generator->text(140);
        $description = Description::fromString($descriptionText);

        $this->assertEquals($descriptionText, $description->__toString());
    }

    public function testItCantConstructDescriptionWithLessThan10Characters(): void
    {
        $descriptionText = $this->generator->text(9);

        $this->expectException(InvalidDescriptionLengthException::class);
        Description::fromString($descriptionText);
    }

    public function testItCantConstructDescriptionWithMoreThan140Characters(): void
    {
        $descriptionText = random_bytes(180);

        $this->expectException(InvalidDescriptionLengthException::class);
        Description::fromString($descriptionText);
    }
}
