<?php
declare(strict_types=1);

namespace App\Infrastructure\Database\DoctrineFixtures;

use App\Infrastructure\Database\DoctrineEntity\Example;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class ExampleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $example = new Example('Hello World!');
        $manager->persist($example);
        $manager->flush();
    }
}
