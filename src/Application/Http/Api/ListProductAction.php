<?php
declare(strict_types=1);

namespace App\Application\Http\Api;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;

final class ListProductAction
{
    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function __invoke(): JsonResponse
    {
        $serialized = $this->serializer->serialize([
            'CALL' => self::class
        ], 'json');

        return new JsonResponse(
            $serialized,
            JsonResponse::HTTP_OK,
            [],
            true
        );
    }
}
