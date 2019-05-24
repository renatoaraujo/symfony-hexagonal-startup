<?php

namespace App\Tests\Application\Http\Example;

use App\Tests\Database\Fixtures\ExampleFixture;
use Liip\FunctionalTestBundle\Test\WebTestCase;

final class GetExampleDataTest extends WebTestCase
{
    public function testGetExampleDataWithSuccessfulRequest(): void
    {
        $this->loadFixtures([
            ExampleFixture::class,
        ]);

        $client = $this->makeClient();
        $client->request('GET', '/example');
        $this->assertStatusCode(200, $client);
    }
}