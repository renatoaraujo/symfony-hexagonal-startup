<?php
declare(strict_types=1);

namespace App\Application\Http\Example;

use App\Core\Example\Service;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;

final class GetExampleData
{
    private Service $service;

    private SerializerInterface $serializer;

    public function __construct(Service $service, SerializerInterface $serializer)
    {
        $this->service = $service;
        $this->serializer = $serializer;
    }

    public function __invoke(): JsonResponse
    {
        $exampleData = $this->service->loadExampleData();
        $serialized = $this->serializer->serialize($exampleData, 'json');

        return new JsonResponse($serialized, JsonResponse::HTTP_OK, ['Content-Type' => 'application/json'], true);
    }
}
