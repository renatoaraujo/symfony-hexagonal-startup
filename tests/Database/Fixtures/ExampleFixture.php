<?php

namespace App\Tests\Database\Fixtures;

use App\Infrastructure\Database\DoctrineEntity\Example;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class ExampleFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $example = new Example('just a test');
        $manager->persist($example);
        $manager->flush();
    }
}
