<?php

namespace App\DataFixtures;

use App\Entity\Wish;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for($i = 1; $i <=3; $i++) {
            $wish = new Wish();
            $wish->setTitle($faker->sentence());
            $wish->setDescription($faker->text());
            $wish->setAuthor($faker->firstName());
            $wish->setIsPublished('true');
            $wish->setDateCreated($faker->dateTimeBetween('-6 months', 'now'));

            $manager->persist($wish);
        }
        
        $manager->flush();
    }
}
