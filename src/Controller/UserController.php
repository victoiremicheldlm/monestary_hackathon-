<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\VehicleRepository;
use App\Service\Calculation;
use App\Service\Geoloc;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;


#[Route('/user', name: 'app_user_')]
class UserController extends AbstractController
{
    /**
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     */
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        /**
         * @var ?User $user
         */
        $user = $this->getUser();
        return $this->json(data: $user, context: ['groups' => 'user']);
    }

    #[Route('/aroundme', name: 'aroundme')]
    public function aroundme(
        Geoloc $geoloc,
        VehicleRepository $vehicleRepository,
        Calculation $calculation): Response
    {
        $ip_address = "185.108.106.0";
        $userCoordinate = $geoloc->getCoordinateFromIp($ip_address);

        $tot = $vehicleRepository->count(
            ['status' => 'available']
        );

        for ($i = 0; $i < $tot; $i++) {
            $vehicles = $vehicleRepository->findBy(
                ['status' => 'available'],
                limit: 1,
                offset: $i,
            );
            $dist = $calculation->distance(
                $userCoordinate['latitude'],
                $userCoordinate['longitude'],
                $vehicles[0]->getLatitude(),
                $vehicles[0]->getLongitude(),
            );
            $vehicles[0]->setDistance($dist);
            $vehicleRepository->add($vehicles[0], true);
        }

        $result = $vehicleRepository->findBy(
            ['status' => 'available'],
            orderBy: ['distance' => 'ASC'],
            limit: 10
        );


        return $this->json($result, context: ['groups' => 'vehicle']);
    }

    #[Route('/test', name: 'test')]
    public function test(): Response
    {

        /**
         * @var ?User $user
         */
        $user = $this->getUser();


        return $this->json($user->getCustomer()->getVehicles());
    }
}
