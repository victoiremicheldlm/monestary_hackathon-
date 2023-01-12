<?php

namespace App\DataFixtures;

use DateTime;
use Faker\Factory;
use App\Entity\Schedule;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ScheduleFixtures extends Fixture implements DependentFixtureInterface
{
    public static int $scheduleIndex = 0;
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for ($j = 1; $j <=10; $j++) {
            self::$scheduleIndex++;
                $schedule = new Schedule();
                $schedule->setVehicle($this->getReference('vehicle_' . rand(1, VehicleFixtures::$vehicleIndex)));
                $schedule->setStartAt($faker->dateTimeBetween('-2 weeks' , '-1 week'));
                $schedule->setEndAt($faker->dateTimeBetween('-1 week' , '+1 week'));
                $manager->persist($schedule);
                $this->addReference('schedule_' . self::$scheduleIndex, $schedule);
                
        }
            $manager->flush();
    }

    
    public function getDependencies(): array
    {
        return [
           VehicleFixtures::class,
           UserFixtures::class,
        ];
    }
}