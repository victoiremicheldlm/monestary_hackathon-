<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Vehicule;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Encoder\DecoderInterface;

class VehiculeFixtures extends Fixture
{
    public static int $vehiculeIndex = 0;

    public function __construct(
        private readonly ContainerBagInterface $containerBag,
        private readonly DecoderInterface $decoder
    ) {
    }


    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $file = 'vehicule_detail.csv';
        $filePath = __DIR__ . '/data/' . $file;
        $context = [
            CsvEncoder::DELIMITER_KEY => ',',
            CsvEncoder::ENCLOSURE_KEY => '"',
            CsvEncoder::ESCAPE_CHAR_KEY => '\\',
            CsvEncoder::KEY_SEPARATOR_KEY => ',',
        ];
        $csv = $this->decoder->decode(file_get_contents($filePath), 'csv', $context);
        foreach ($csv as $vehiculeDetail) {
            self::$vehiculeIndex++;
            $vehicule = new Vehicule();
            $vehicule->setModel($vehiculeDetail['model']);
            $vehicule->setBrand($vehiculeDetail['brand']);
            $vehicule->setPower($vehiculeDetail['power']);
            $vehicule->setEnergy($vehiculeDetail['energy']);
            $vehicule->setLoadCapacity($vehiculeDetail['load_capacity']);
            $vehicule->setDescription($faker->paragraph(1, true));
            $vehicule->setPassenger($vehiculeDetail['passenger']);
            $vehicule->setLocation($vehiculeDetail['location']);
            $vehicule->setStatus($vehiculeDetail['status']);
            $vehicule->setMilage($vehiculeDetail['milage']);
            $vehicule->setPrice($vehiculeDetail['price']);
            // $vehicule->setEnterprise($this->getReference('user_' . rand(1, 10)));
            $vehicule->setNumberplate($vehiculeDetail['numberplate']);
            $vehicule->setColor($vehiculeDetail['color']);
            $vehicule->setGeneralState($vehiculeDetail['general_state']);

            $file = __DIR__ . '/data/cars/' . $vehiculeDetail['photo'] . '.png';
            if (
                copy($file, $this->containerBag->get('upload_directory') .
                'images/cars/' . $vehiculeDetail['photo'] . '.png')
            ) {
                $vehicule->setPhoto($vehiculeDetail['photo'] . '.png');
            }
            $this->addReference('vehicule_' . self::$vehiculeIndex, $vehicule);
            $manager->persist($vehicule);
        }
        $manager->flush();
    }
}