<?php
declare(strict_types=1);

namespace App\Domain\Exception;

final class InvalidUrlException extends \Exception
{
    public static function fromInvalidValue(string $value): InvalidUrlException
    {
        return new self(
            sprintf('Invalid url given: %s', $value)
        );
    }
}
