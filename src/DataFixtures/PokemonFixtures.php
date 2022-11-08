<?php

namespace App\DataFixtures;

use App\Entity\Pokemon;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PokemonFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i=0; $i<50; $i++) {
            $object = (new Pokemon())
                ->setName($faker->colorName)
                ->setDescription($faker->paragraph);
            $manager->persist($object);
        }

        $manager->flush();
    }
}
