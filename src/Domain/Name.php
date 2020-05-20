<?php
declare(strict_types=1);

namespace App\Domain;

use App\Domain\Exception\EmptyProductNameException;
use App\Domain\Exception\InavalidProductNameException;

final class Name
{
    private string $name;

    private function __construct()
    {
    }

    public static function fromString(string $name): Name
    {
        if (empty($name)) {
            throw new EmptyProductNameException();
        }

        if (3 < strlen($name)) {
            throw InavalidProductNameException::withInvalidLength($name);
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
