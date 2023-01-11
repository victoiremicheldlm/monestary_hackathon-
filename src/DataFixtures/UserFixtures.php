<?php

namespace App\DataFixtures;

use App\Entity\Candidat;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public static int $userAdminIndex = 0;
    public static int $userDriverIndex = 0;
    public static int $userCustomerIndex = 0;
    public static int $userEnterpriseIndex = 0;

    public const ADMIN = [
            'email' => 'admin',
            'pass' => 'motdepasse',
            'role' => 'ROLE_ADMIN',
    ];

    public const DRIVER = [
            'email' => 'driver',
            'pass' => 'motdepasse',
            'role' => 'ROLE_DRIVER'
    ];

    public const CUSTOMER = [
            'email' => 'driver',
            'pass' => 'motdepasse',
            'role' => 'ROLE_'
    ];

    public const ENTERPRISE = [
        'enterprise' => [
            'email' => 'driver',
            'pass' => 'motdepasse',
            'role' => 'ROLE_DRIVER'
        ],
    ];

    public function __construct(private readonly UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 1; $i <= 2; $i++) {
            self::$userAdminIndex++;
            $user = new User();
            $user->setEmail('admin' . $i . '@mail.fr');

            $hashedPassword = $this->passwordHasher->hashPassword(
                $user,
                'motdepasse'
            );
            $user->setPassword($hashedPassword);
            $user->setRoles(['ROLE_ADMIN']);

            $manager->persist($user);
            $this->addReference('userAdmin_' . self::$userAdminIndex, $user);
        }

        for ($i = 1; $i <= 5; $i++) {
            self::$userDriverIndex++;
            $user = new User();
            $user->setEmail('driver' . $i . '@mail.fr');

            $hashedPassword = $this->passwordHasher->hashPassword(
                $user,
                'motdepasse'
            );
            $user->setPassword($hashedPassword);
            $user->setRoles(['ROLE_DRIVER']);

            $manager->persist($user);
            $this->addReference('userDriver_' . self::$userDriverIndex, $user);
        }

        for ($i = 1; $i <= 10; $i++) {
            self::$userCustomerIndex++;
            $user = new User();
            $user->setEmail('customer' . $i . '@mail.fr');

            $hashedPassword = $this->passwordHasher->hashPassword(
                $user,
                'motdepasse'
            );
            $user->setPassword($hashedPassword);
            $user->setRoles(['ROLE_CUSTOMER']);

            $manager->persist($user);
            $this->addReference('userCustomer_' . self::$userCustomerIndex, $user);
        }

        for ($i = 1; $i <= 10; $i++) {
            self::$userEnterpriseIndex++;
            $user = new User();
            $user->setEmail('enterprise' . $i . '@mail.fr');

            $hashedPassword = $this->passwordHasher->hashPassword(
                $user,
                'motdepasse'
            );
            $user->setPassword($hashedPassword);
            $user->setRoles(['ROLE_ENTERPRISE']);

            $manager->persist($user);
            $this->addReference('userEnterprise_' . self::$userEnterpriseIndex, $user);
        }

        $manager->flush();
    }
}
