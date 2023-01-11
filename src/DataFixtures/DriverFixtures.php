<?php

namespace App\DataFixtures;

use App\Entity\Driver;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class DriverFixtures extends Fixture implements DependentFixtureInterface
{
    public static int $driverIndex = 0;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 1; $i <= UserFixtures::$userDriverIndex; $i++) {
            self::$driverIndex++;
            $driver = new Driver();
            $driver->setUser($this->getReference('userDriver_' . $i));
            $driver->setFirstname($faker->firstName);
            $driver->setLastname($faker->lastName);
            $driver->setPhone($faker->phoneNumber);
            $driver->setAvatar('https://i.pravatar.cc/300?img=' . $i);
            $driver->setAddress($faker->address);
            $driver->setZipCode($faker->postcode);
            $driver->setCountry('France');
            $driver->setDescription($faker->paragraph());
            $manager->persist($driver);
            $this->addReference('driver_' . self::$driverIndex, $driver);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}
