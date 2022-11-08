<?php

namespace App\DataFixtures;

use App\Entity\Nature;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class NatureFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i=0; $i<50; $i++) {
            $object = (new Nature())
                ->setName($faker->colorName);
            $manager->persist($object);
        }

        $manager->flush();
    }
}
