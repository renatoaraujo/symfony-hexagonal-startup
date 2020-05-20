<?php
declare(strict_types=1);

namespace App\Domain\Exception;

final class InavalidProductNameException extends \Exception
{
    public static function withInvalidLength(string $name): InavalidProductNameException
    {
        return new self(
            sprintf('Product name must have more than 3 characters. Given (%d) %s', strlen($name), $name)
        );
    }
}
