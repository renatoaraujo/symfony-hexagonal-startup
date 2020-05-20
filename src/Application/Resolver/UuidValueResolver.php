<?php
declare(strict_types=1);

namespace App\Application\Resolver;

use Iterator;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

final class UuidValueResolver implements ArgumentValueResolverInterface
{
    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return is_a($argument->getType(), UuidInterface::class, true);
    }

    public function resolve(Request $request, ArgumentMetadata $argument): Iterator
    {
        $argumentValue = $request->get($argument->getName());
        if (! is_string($argumentValue)) {
            yield null;
        }

        yield Uuid::fromString($argumentValue);
    }
}
