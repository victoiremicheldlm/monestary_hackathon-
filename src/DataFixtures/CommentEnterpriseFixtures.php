<?php

namespace App\DataFixtures;

use App\Entity\CommentEnterprise;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CommentEnterpriseFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 1; $i <= EnterpriseFixtures::$enterpriseIndex; $i++) {
            $number = rand(1,5);
            for ($j = 1; $j <= $number; $j++) {
                $commentEnterprise = new CommentEnterprise();
                $commentEnterprise->setCustomer($this->getReference('customer_' . $faker->unique()->numberBetween(1, CustomerFixtures::$customerIndex)));
                $commentEnterprise->setEnterprise($this->getReference('enterprise_' . $i));
                $commentEnterprise->setRating($faker->numberBetween(1,5));
                $commentEnterprise->setContent($faker->paragraph());
                $manager->persist($commentEnterprise);
            }
            $faker->unique(true);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CustomerFixtures::class,
            EnterpriseFixtures::class
        ];
    }
}
