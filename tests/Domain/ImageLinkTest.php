<?php
declare(strict_types=1);

namespace App\Tests\Domain;

use App\Domain\Exception\InvalidUrlException;
use App\Domain\ImageLink;
use Faker\Generator;
use PHPUnit\Framework\TestCase;
use Faker;

final class ImageLinkTest extends TestCase
{
    private Generator $generator;

    public function setUp(): void
    {
        $this->generator = Faker\Factory::create();
    }

    public function testItCanConstructImageLink(): void
    {
        $url = $this->generator->url;
        $imageLink = ImageLink::fromString($url);
        $this->assertEquals($url, $imageLink->__toString());
    }

    public function testItCantConstructImageLinkWithInvalidUrl(): void
    {
        $url = md5(uniqid('URL', true));

        $this->expectException(InvalidUrlException::class);
        ImageLink::fromString($url);
    }
}
