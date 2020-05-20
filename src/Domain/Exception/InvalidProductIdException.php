<?php
declare(strict_types=1);

namespace App\Domain\Exception;

final class InvalidProductIdException extends \Exception
{
    public static function withInvalidUuid(string $uuid): InvalidProductIdException
    {
        return new self(
            sprintf('Invalid product ID. Given %s', $uuid)
        );
    }
}
