<?php
declare(strict_types=1);

namespace App\Tests\Domain;

use App\Domain\Exception\EmptyNameException;
use App\Domain\Exception\InvalidNameLengthException;
use App\Domain\Name;
use Faker\Generator;
use PHPUnit\Framework\TestCase;
use Faker;

final class NameTest extends TestCase
{
    private Generator $generator;

    public function setUp(): void
    {
        $this->generator = Faker\Factory::create();
    }

    public function testItCanConstructName(): void
    {
        $nameText = $this->generator->text(100);
        $name = Name::fromString($nameText);
        $this->assertEquals($nameText, $name->__toString());
    }

    public function testItCantConstructNameWithLessThan3Characters(): void
    {
        $this->expectException(InvalidNameLengthException::class);
        $nameText = random_bytes(1);
        Name::fromString($nameText);
    }

    public function testItCantConstructEmptyName(): void
    {
        $this->expectException(EmptyNameException::class);
        Name::fromString('');
    }

    public function testItCantConstructNameWithMoreThan100Characters(): void
    {
        $this->expectException(InvalidNameLengthException::class);
        $nameText = random_bytes(180);
        Name::fromString($nameText);
    }
}
