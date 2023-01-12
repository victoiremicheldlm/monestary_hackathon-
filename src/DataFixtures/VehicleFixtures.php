<?php

namespace App\DataFixtures;

use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;
use App\Entity\Vehicle;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Encoder\DecoderInterface;

class VehicleFixtures extends Fixture implements DependentFixtureInterface
{
    public static int $vehicleIndex = 0;

    public function __construct(
        private readonly ContainerBagInterface $containerBag,
        private readonly DecoderInterface $decoder
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $file = 'vehicle_detail.csv';
        $filePath = __DIR__ . '/data/' . $file;
        $context = [
            CsvEncoder::DELIMITER_KEY => ',',
            CsvEncoder::ENCLOSURE_KEY => '"',
            CsvEncoder::ESCAPE_CHAR_KEY => '\\',
            CsvEncoder::KEY_SEPARATOR_KEY => ',',
        ];
        $csv = $this->decoder->decode(file_get_contents($filePath), 'csv', $context);
        foreach ($csv as $vehicleDetail) {
            self::$vehicleIndex++;
            $vehicle = new Vehicle();
            $vehicle->setModel($vehicleDetail['model']);
            $vehicle->setBrand($vehicleDetail['brand']);
            $vehicle->setPower($vehicleDetail['power']);
            $vehicle->setEnergy($vehicleDetail['energy']);
            $vehicle->setLoadCapacity($vehicleDetail['load_capacity']);
            $vehicle->setDescription($faker->paragraph(1, true));
            $vehicle->setPassenger($vehicleDetail['passenger']);
            $vehicle->setLocation($vehicleDetail['location']);
            $vehicle->setStatus($vehicleDetail['status']);
            $vehicle->setMilage($vehicleDetail['milage']);
            $vehicle->setPrice($vehicleDetail['price']);
            $vehicle->setEnterprise($this->getReference('enterprise_' . $faker->numberBetween(1, EnterpriseFixtures::$enterpriseIndex)));
            $vehicle->setNumberplate($vehicleDetail['numberplate']);
            $vehicle->setColor($vehicleDetail['color']);
            $vehicle->setGeneralState($vehicleDetail['general_state']);

            $file = __DIR__ . '/data/cars/' . $vehicleDetail['photo'] . '.png';
            if (
                copy($file, $this->containerBag->get('upload_directory') .
                    'images/cars/' . $vehicleDetail['photo'] . '.png')
            ) {
                $vehicle->setPhoto($vehicleDetail['photo'] . '.png');
            }
            $this->addReference('vehicle_' . self::$vehicleIndex, $vehicle);
            $manager->persist($vehicle);
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