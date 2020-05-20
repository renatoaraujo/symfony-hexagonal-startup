<?php
declare(strict_types=1);

namespace App\Domain\Exception;

final class ZeroOrNegativePriceException extends \Exception
{
    protected $message = 'Zero or negative value for price not allowed.';
}
