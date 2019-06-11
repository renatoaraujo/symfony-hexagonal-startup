<?php
declare(strict_types=1);

namespace App\Infrastructure\Subscriber;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Serializer\SerializerInterface;

final class ExceptionSubscriber implements EventSubscriberInterface
{
    /** @var LoggerInterface */
    private $logger;

    /** @var SerializerInterface */
    private $serializer;

    public function __construct(LoggerInterface $logger, SerializerInterface $serializer)
    {
        $this->logger = $logger;
        $this->serializer = $serializer;
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getException();
        $statusCode = 500;

        if ($exception->getCode() >= 400 && $exception->getCode() <= 599) {
            $statusCode = $exception->getCode();
        }

        $failure = $this->createFailureObject($exception->getMessage(), $exception->getCode());

        $response = new JsonResponse(
            $this->serializer->serialize($failure, 'json'),
            $statusCode,
            [
                'Content-Type' => 'application/json',
            ],
            true
        );

        $this->generateLogs($exception);
        $event->setResponse($response);
    }

    private function generateLogs(\Throwable $exception)
    {
        $this->logger->error('Failure', [
            'Message' => $exception->getMessage(),
            'Stack Trace' => $exception->getTraceAsString(),
        ]);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => 'onKernelException',
        ];
    }

    private function createFailureObject(string $message, int $code): \JsonSerializable
    {
        return new class($code, $message) implements \JsonSerializable {
            /** @var int */
            private $code;

            /** @var string */
            private $message;

            public function __construct(int $code, string $message)
            {
                $this->code = $code;
                $this->message = $message;
            }

            public function jsonSerialize(): array
            {
                return [
                    'code' => $this->code,
                    'message' => $this->message
                ];
            }
        };
    }
}
