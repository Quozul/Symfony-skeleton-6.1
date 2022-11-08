<?php

namespace App\DataFixtures;

use App\Entity\Nature;
use App\Entity\Pokemon;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PokemonFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $natures = $manager->getRepository(Nature::class)->findAll();

        for ($i = 0; $i < 50; $i++) {
            $object = (new Pokemon())
                ->setName($faker->colorName)
                ->setDescription($faker->paragraph)
                ->setNature($faker->randomElement($natures));
            $manager->persist($object);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [NatureFixtures::class];
    }
}
