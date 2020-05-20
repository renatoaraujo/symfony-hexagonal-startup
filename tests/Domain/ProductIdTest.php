<?php
declare(strict_types=1);

namespace App\Tests\Domain;

use App\Domain\Exception\EmptyProductIdException;
use App\Domain\Exception\InvalidProductIdException;
use App\Domain\ProductId;
use Faker\Generator;
use PHPUnit\Framework\TestCase;
use Faker;
use Ramsey\Uuid\Uuid;

final class ProductIdTest extends TestCase
{
    private Generator $generator;

    public function setUp(): void
    {
        $this->generator = Faker\Factory::create();
    }

    public function testItCanConstructProductIdFromString(): void
    {
        $uuid = $this->generator->uuid;
        $productId = ProductId::fromString($uuid);
        $this->assertEquals($uuid, $productId->__toString());

        $uuidObject = Uuid::fromString($uuid);
        $this->assertEquals($uuidObject, $productId->toUuid());
    }

    public function testItCanConstructProductIdFromUuidObject(): void
    {
        $uuidObject = Uuid::uuid4();
        $productId = ProductId::fromUuid($uuidObject);
        $this->assertEquals($uuidObject, $productId->toUuid());

        $uuid = $uuidObject->toString();
        $this->assertEquals($uuid, $productId->__toString());
    }

    public function testItCantConstructProductIdFromEmptyString(): void
    {
        $this->expectException(EmptyProductIdException::class);
        ProductId::fromString('');
    }

    public function testItCantConstructProductIdFromInvalidUuid(): void
    {
        $this->expectException(InvalidProductIdException::class);
        $invalidUuidString = random_bytes(150);
        ProductId::fromString($invalidUuidString);
    }
}
