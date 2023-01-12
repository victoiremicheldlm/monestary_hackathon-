<?php

namespace App\Service;


use Symfony\Component\HttpClient\HttpClient;

class Geoloc
{
    public function getCoordinateFromIp(string $ipAdress): array
    {
// Récupération d'un objet HttpClient :
        $client = HttpClient::create();

        //Récupération coordonnées de l'utilisateur ici IP en dur pour utilisation localhost
        $response = $client->request('GET', 'http://api.ipapi.com/' .
            $ipAdress . '?access_key=2d997fde9198b489e9719e0e83dc6430');

        $statusCode = $response->getStatusCode();
        $type = $response->getHeaders()['content-type'][0];

        $content = '';

        if ($statusCode === 200 && $type === 'application/json') {
            $content = $response->getContent();
            // get the response in JSON format

            $content = $response->toArray();
            // convert the response (here in JSON) to an PHP array
        }

        $coordinate = [];

        $coordinate['latitude'] = $content['latitude'];
        $coordinate['longitude'] = $content['longitude'];
        $coordinate['city'] = explode(' ', $content['city'])[0];
        $coordinate['region'] = $content['region_name'];
        $coordinate['country'] = $content['country_name'];
        $coordinate['code'] = $content['country_code'];

        return $coordinate;
    }
}