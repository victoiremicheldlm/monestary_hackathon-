<?php

namespace App\DataFixtures;

use App\Entity\Vehicle;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class VehicleFixtures extends Fixture implements DependentFixtureInterface
{
    public const STATUS = ['available', 'retired', 'used', 'repair'];

    public static int $vehicleIndex = 0;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i = 1; $i <= EnterpriseFixtures::$enterpriseIndex; $i++) {
            for ($j = 1; $j <= 10; $j++) {
                self::$vehicleIndex++;
                $vehicle = new Vehicle();
                $vehicle->setBrand('Constructeur' . $faker->numberBetween(1,5));
                $vehicle->setModel('Model' . $faker->numberBetween(1,5));
                $vehicle->setPower($faker->numberBetween(100,300));
                $vehicle->setLoadCapacity($faker->numberBetween(2,7));
                $vehicle->setMilage($faker->numberBetween(1000,100000));
                $vehicle->setStatus(self::STATUS[array_rand(self::STATUS)]);
                $vehicle->setEnterprise($this->getReference('enterprise_' . $i));
                $vehicle->setColor($faker->colorName);
                $manager->persist($vehicle);
                $this->addReference('vehicle_' . self::$vehicleIndex, $vehicle);
            }
        }


        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            EnterpriseFixtures::class
        ];
    }
}
