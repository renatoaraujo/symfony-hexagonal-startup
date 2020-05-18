<?php
declare(strict_types=1);

namespace App\Infrastructure\Database\DoctrineRepository;

use App\Core\Example\Repository\ExampleRepository;
use App\Infrastructure\Database\DoctrineEntity\Example;
use Doctrine\ORM\EntityManagerInterface;

final class DoctrineExampleRepository implements ExampleRepository
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function load(): array
    {
        $repository = $this
            ->entityManager
            ->getRepository(Example::class);

        return $repository->findAll();
    }
}
