<?php
declare(strict_types=1);

namespace App\Infrastructure\Database\DoctrineEntity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="example")
 */
class Example
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     */
    private UuidInterface $id;

    /**
     * @ORM\Column(type="string")
     */
    private string $value;

    public function __construct(string $value)
    {
        $this->id = Uuid::uuid4();
        $this->value = $value;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
