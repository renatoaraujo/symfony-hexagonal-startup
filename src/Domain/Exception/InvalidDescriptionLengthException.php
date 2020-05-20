<?php
declare(strict_types=1);

namespace App\Domain\Exception;

final class InvalidDescriptionLengthException extends \Exception
{
    public static function fromMinLengthViolation(int $length): InvalidDescriptionLengthException
    {
        return new self(
            sprintf('Invalid description, min length allowed 10. Given %d', $length)
        );
    }

    public static function fromMaxLengthViolation(int $length): InvalidDescriptionLengthException
    {
        return new self(
            sprintf('Invalid description, max length allowed 140. Given %d', $length)
        );
    }
}
