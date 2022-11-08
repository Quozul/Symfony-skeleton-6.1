<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $pwd = '$2y$13$v463V4wmj1aLaEqD8slhNONAnr1fyxvWSXop7YK66h/5Pse5v1//a'; // 'abc'

        $object = (new User())
            ->setEmail('user@example.com')
            ->setRoles([])
            ->setPassword($pwd);
        $manager->persist($object);

        $object = (new User())
            ->setEmail('creator@example.com')
            ->setRoles(['ROLE_CREATOR'])
            ->setPassword($pwd);
        $manager->persist($object);

        $object = (new User())
            ->setEmail('admin@example.com')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword($pwd);
        $manager->persist($object);

        $manager->flush();
    }
}
