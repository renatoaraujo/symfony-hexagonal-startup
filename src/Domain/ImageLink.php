<?php
declare(strict_types=1);

namespace App\Domain;

use App\Domain\Exception\InvalidUrlException;

final class ImageLink
{
    private string $url;

    private function __construct()
    {
    }

    public static function fromString(string $url): ImageLink
    {
        if (false === filter_var($url, FILTER_VALIDATE_URL)) {
            throw InvalidUrlException::fromInvalidValue($url);
        }

        $imageLinkInstance = new self();
        $imageLinkInstance->url = $url;
        return $imageLinkInstance;
    }

    public function __toString(): string
    {
        return $this->url;
    }
}
