<?php
declare(strict_types=1);

namespace App\Domain;

final class Name
{
    private string $name;

    private function __construct()
    {
    }

    public static function fromString(string $name): Name
    {
        $nameInstance = new self();
        $nameInstance->name = $name;

        return $nameInstance;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
