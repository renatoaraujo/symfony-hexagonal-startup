<?php
declare(strict_types=1);

namespace App\Domain\Exception;

final class EmptyProductIdException extends \Exception
{
    protected $message = 'Product ID missing.';
}
