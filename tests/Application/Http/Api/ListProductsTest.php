<?php
declare(strict_types=1);

namespace App\Tests\Application\Http\Api;

use App\Application\Http\Api\ListProductAction;
use Liip\FunctionalTestBundle\Test\WebTestCase;

final class ListProductsTest extends WebTestCase
{
    public function testItListProducts(): void
    {
        $client = $this->makeClient();
        $client->request('GET', '/product');
        self::assertStatusCode(200, $client);

        $data = $client->getResponse()->getContent();
        $unserializedData = json_decode($data, true, 512, JSON_THROW_ON_ERROR);
        $this->assertArrayHasKey('CALL', $unserializedData);
        $object = $unserializedData['CALL'];
        $this->assertEquals($object, ListProductAction::class);
    }
}
