<?php
declare(strict_types=1);

namespace App\Application\Http\Api;

use Ramsey\Uuid\UuidInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;

final class ReadProductAction
{
    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function __invoke(UuidInterface $uuid): JsonResponse
    {
        $serialized = $this->serializer->serialize([
            'CALL' => self::class,
            'UUID' => $uuid->toString()
        ], 'json');

        return new JsonResponse(
            $serialized,
            JsonResponse::HTTP_OK,
            [],
            true
        );
    }
}
