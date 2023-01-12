<?php

namespace App\DataFixtures;

use App\Entity\CommentVehicle;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CommentVehicleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 1; $i <= VehicleFixtures::$vehicleIndex; $i++) {
            $number = rand(1,5);
            for ($j = 1; $j <= $number; $j++) {
                $commentVehicle = new CommentVehicle();
                $commentVehicle->setCustomer($this->getReference('customer_' . $faker->unique()->numberBetween(1, CustomerFixtures::$customerIndex)));
                $commentVehicle->setVehicle($this->getReference('vehicle_' . $i));
                $commentVehicle->setRating($faker->numberBetween(1,5));
                $commentVehicle->setContent($faker->paragraph());
                $manager->persist($commentVehicle);
            }
            $faker->unique(true);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CustomerFixtures::class,
            VehicleFixtures::class
        ];
    }
}