<?php
declare(strict_types=1);

namespace App\Domain\Exception;

final class EmptyProductNameException extends \Exception
{
    protected $message = 'Please inform the product name.';
}
