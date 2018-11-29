<?php
declare(strict_types=1);

namespace App\Infrastructure\Database\DoctrineEntity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity
 * @ORM\Table(name="example")
 */
class Example
{
    /**
     * @var \Ramsey\Uuid\UuidInterface
     *
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $value;

    public function __construct(string $value)
    {
        $this->id = Uuid::uuid4();
        $this->value = $value;
    }

    public function getId(): \Ramsey\Uuid\UuidInterface
    {
        return $this->id;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
