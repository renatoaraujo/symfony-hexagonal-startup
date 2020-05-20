<?php
declare(strict_types=1);

namespace App\Domain\Exception;

final class EmptyNameException extends \Exception
{
    protected $message = 'Please inform the product name.';
}
