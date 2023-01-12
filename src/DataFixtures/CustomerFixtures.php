<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CustomerFixtures extends Fixture implements DependentFixtureInterface
{
    public static int $customerIndex = 0;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 1; $i <= UserFixtures::$userCustomerIndex; $i++) {
            self::$customerIndex++;
            $customer = new Customer();
            $customer->setUser($this->getReference('userCustomer_' . $i));
            $customer->setFirstname($faker->firstName);
            $customer->setLastname($faker->lastName);
            $customer->setPhone($faker->phoneNumber);
            $customer->setAvatar('https://i.pravatar.cc/300?img=' . $i+10);
            $customer->setAddress($faker->address);
            $customer->setZipCode($faker->postcode);
            $customer->setCountry('France');
            $customer->setDescription($faker->paragraph());
            for ($j = 0; $j < 2; $j++) {
                $customer->addEnterprise($this->getReference('enterprise_' . $faker->unique()->numberBetween(1, EnterpriseFixtures::$enterpriseIndex)));
            }
            $faker->unique(true);
            $number = rand(1,5);
            for ($k = 1; $k <= $number; $k++) {
                $customer->addVehicle($this->getReference('vehicle_' . $faker->unique()->numberBetween(1, VehicleFixtures::$vehicleIndex)));
            }
            $faker->unique(true);
            $manager->persist($customer);
            $this->addReference('customer_' . self::$customerIndex, $customer);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            EnterpriseFixtures::class,
            VehicleFixtures::class,
        ];
    }
}
