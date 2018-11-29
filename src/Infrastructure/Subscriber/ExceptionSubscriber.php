<?php
declare(strict_types=1);

namespace App\Infrastructure\Subscriber;

use Psr\Log\LoggerInterface;
use Symfony\Component\{
    HttpFoundation\JsonResponse,
    EventDispatcher\EventSubscriberInterface,
    HttpKernel\Event\GetResponseForExceptionEvent,
    HttpKernel\KernelEvents,
    Serializer\SerializerInterface};

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

    public function onKernelException(GetResponseForExceptionEvent $event): void
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
        $this->logger->error('Falha na execução', [
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

    private function createFailureObject(string $message, int $code)
    {
        return new class($message, $code) implements \JsonSerializable {
            /** @var string */
            private $code;

            /** @var int */
            private $message;

            public function __construct(string $code, int $message)
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
