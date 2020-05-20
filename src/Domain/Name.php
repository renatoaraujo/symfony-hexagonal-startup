<?php
declare(strict_types=1);

namespace App\Domain;

use App\Domain\Exception\EmptyProductNameException;
use App\Domain\Exception\InvalidNameLengthException;

final class Name
{
    private string $name;

    private function __construct()
    {
    }

    /**
     * @throws EmptyProductNameException
     * @throws InvalidNameLengthException
     */
    public static function fromString(string $name): Name
    {
        if (empty($name)) {
            throw new EmptyProductNameException();
        }

        if (3 > strlen($name)) {
            throw InvalidNameLengthException::fromMinLengthViolation($name);
        }

        if (100 < strlen($name)) {
            throw InvalidNameLengthException::fromMaxLengthViolation($name);
        }

        $nameInstance = new self();
        $nameInstance->name = $name;

        return $nameInstance;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
