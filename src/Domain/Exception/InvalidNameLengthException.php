<?php
declare(strict_types=1);

namespace App\Domain\Exception;

final class InvalidNameLengthException extends \Exception
{
    public static function fromMinLengthViolation(string $name): InvalidNameLengthException
    {
        return new self(
            sprintf('Invalid description, min length allowed 10. Given %d (%s)', strlen($name), $name)
        );
    }

    public static function fromMaxLengthViolation(string $name): InvalidNameLengthException
    {
        return new self(
            sprintf('Invalid description, max length allowed 10. Given %d (%s)', strlen($name), $name)
        );
    }
}
