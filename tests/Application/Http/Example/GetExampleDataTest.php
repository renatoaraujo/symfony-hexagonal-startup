<?php
declare(strict_types=1);

namespace App\Tests\Application\Http\Example;

use Liip\FunctionalTestBundle\Test\WebTestCase;

final class GetExampleDataTest extends WebTestCase
{
    public function testGetExampleDataWithSuccessfulRequest(): void
    {
        $client = $this->makeClient();
        $client->request('GET', '/example');
        $this->assertStatusCode(200, $client);
    }
}
