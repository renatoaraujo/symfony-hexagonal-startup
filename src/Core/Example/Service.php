<?php
declare(strict_types=1);

namespace App\Core\Example;

use App\Core\Example\Repository\ExampleRepository;

final class Service
{
    private ExampleRepository $exampleRepository;

    public function __construct(ExampleRepository $exampleRepository)
    {
        $this->exampleRepository = $exampleRepository;
    }

    public function loadExampleData(): array
    {
        return $this->exampleRepository->load();
    }
}
