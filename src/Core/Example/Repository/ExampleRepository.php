<?php
declare(strict_types=1);

namespace App\Core\Example\Repository;

interface ExampleRepository
{
    public function load(): array;
}
