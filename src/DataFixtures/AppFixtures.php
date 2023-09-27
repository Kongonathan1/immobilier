<?php

namespace App\DataFixtures;

use App\Entity\Properties;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for($i=1; $i<25; $i++) {
            $property = new Properties();
            $property->setTitle($faker->company())
                     ->setAddress($faker->address())
                     ->setPostalCode($faker->postcode())
                     ->setCity($faker->city())
                     ->setDescription($faker->paragraph(random_int(4, 12)))
                     ->setBedrooms(random_int(2, 6))
                     ->setRooms(random_int(8, 12))
                     ->setCeil(random_int(0, 18))
                     ->setSold(false)
                     ->setPrice(random_int(65000, 3500000))
                     ->setSurface(random_int(60, 3000))
                     ->setCreatedAt($faker->dateTimeBetween("-15 years"))
                     ->setUpdatedAt(new \DateTime);

            $manager->persist($property);
        }

        $manager->flush();
    }
}
