<?php

namespace App\DataFixtures;

use App\Entity\Enterprise;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class EnterpriseFixtures extends Fixture implements DependentFixtureInterface
{
    public static int $enterpriseIndex = 0;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i = 1; $i <= UserFixtures::$userEnterpriseIndex; $i++) {
            self::$enterpriseIndex++;
            $enterprise = new Enterprise();
            $enterprise->setUser($this->getReference('userEnterprise_' . $i));
            $enterprise->setLogo('https://loremflickr.com/400/400/car?lock=' . $i+10);
            $enterprise->setPhone($faker->phoneNumber);
            $enterprise->setName($faker->word . 'Rental Enterprise');
            $enterprise->setAddress($faker->address);
            $enterprise->setZipCode($faker->postcode);
            $enterprise->setCountry('France');
            $enterprise->setDescription($faker->paragraph());
            $manager->persist($enterprise);
            $this->addReference('enterprise_' . self::$enterpriseIndex, $enterprise);
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