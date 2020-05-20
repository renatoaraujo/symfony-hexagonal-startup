<?php
declare(strict_types=1);

namespace App\Tests\Application\Http\Api;

use App\Application\Http\Api\ReadProductAction;
use Liip\FunctionalTestBundle\Test\WebTestCase;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class ReadProductTest extends WebTestCase
{
    /** @dataProvider uuidProvider */
    public function testItReadProductWithUuid(UuidInterface $uuid): void
    {
        $client = $this->makeClient();
        $client->request('GET', sprintf('/product/%s', $uuid->toString()));
        $this->assertStatusCode(200, $client);

        $data = $client->getResponse()->getContent();
        $unserializedData = \json_decode($data, true, 512, JSON_THROW_ON_ERROR);
        $this->assertArrayHasKey('CALL', $unserializedData);
        $this->assertArrayHasKey('UUID', $unserializedData);
        $object = $unserializedData['CALL'];
        $this->assertEquals($object, ReadProductAction::class);

        $responseId = $unserializedData['UUID'];
        $this->assertEquals($uuid->toString(), $responseId);
    }

    public function uuidProvider(): array
    {
        return [
            [Uuid::uuid4()],
            [Uuid::uuid4()],
            [Uuid::uuid4()],
            [Uuid::uuid4()],
        ];
    }
}
