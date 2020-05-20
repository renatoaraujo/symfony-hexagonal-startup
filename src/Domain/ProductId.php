<?php
declare(strict_types=1);

namespace App\Domain;

use App\Domain\Exception\EmptyProductIdException;
use App\Domain\Exception\InvalidProductIdException;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class ProductId
{
    private string $uuid;

    private function __construct()
    {
    }

    public static function fromUuid(UuidInterface $uuid): ProductId
    {
        $productIdInstance = new self();
        $productIdInstance->uuid = $uuid->toString();
        return $productIdInstance;
    }

    /**
     * @throws InvalidProductIdException
     */
    public static function fromString(string $uuid): ProductId
    {
        if (empty($uuid)) {
            throw new EmptyProductIdException();
        }
        if (!Uuid::isValid($uuid)) {
            throw InvalidProductIdException::withInvalidUuid($uuid);
        }

        $productIdInstance = new self();
        $productIdInstance->uuid = $uuid;
        return $productIdInstance;
    }

    public function toUuid(): UuidInterface
    {
        return Uuid::fromString($this->uuid);
    }

    public function __toString(): string
    {
        return $this->uuid;
    }
}
