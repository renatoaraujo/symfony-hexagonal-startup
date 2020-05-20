<?php
declare(strict_types=1);

namespace App\Domain;

use App\Domain\Exception\InvalidDescriptionLengthException;

final class Description
{
    private string $description;

    private function __construct()
    {
    }

    public static function fromString(string $description): Description
    {
        if (10 > strlen($description)) {
            throw InvalidDescriptionLengthException::fromMinLengthViolation(strlen($description));
        }

        if (140 < strlen($description)) {
            throw InvalidDescriptionLengthException::fromMaxLengthViolation(strlen($description));
        }

        $descriptionInstance = new self();
        $descriptionInstance->description = $description;
        return $descriptionInstance;
    }

    public function __toString(): string
    {
        return $this->description;
    }
}
