<?php

namespace App\Tests\Application\Http\Example;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class GetExampleDataTest extends WebTestCase
{
    public function testGetExampleDataWithSuccessfulRequest(): void
    {
        $client = static::createClient();
        $client->request('GET', '/example');
        $this->assertTrue($client->getResponse()->isSuccessful());
    }
}