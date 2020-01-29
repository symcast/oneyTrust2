<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;


class AddressService
{
    const POSTAL_URL = "https://nominatim.openstreetmap.org/search?q=%s&format=json&polygon=1&addressdetails=1";
    const IP_URL = "https://geo.ipify.org/api/v1?apiKey=%s&ipAddress=%s";

    /** @var HttpClientInterface */
    private $httpClient;

    /** @var string */
    private $apiKey;

    public function __construct(HttpClientInterface $httpClient, string $apiKey)
    {
        $this->httpClient = $httpClient;
        $this->apiKey = $apiKey;
    }

    public function  getLongitudeLatitudeFromPostalAddress(string $address): ?array
    {
        $response = $this->httpClient->request(Request::METHOD_GET, sprintf(self::POSTAL_URL, \urlencode($address)));

        $content = json_decode( $response->getContent(), true);

        return isset($content[0]['lat']) && isset($content[0]['lon'])
            ? ['lat' => (string)$content[0]['lat'], 'lon' => (string)$content[0]['lon']]
            : null;
    }

    public function  getLongitudeLatitudeFromIpAddress(string $ip): ?array
    {
        $response = $this->httpClient->request(Request::METHOD_GET, sprintf(self::IP_URL, $this->apiKey, $ip));

        $content = json_decode($response->getContent(), true);

        $location = $content['location'];

        return ['lat' => (string)$location['lat'], 'lon' => (string)$location['lng']];
    }


    // https://www.geodatasource.com/developers/php
    function distance(string $lat1, string $lon1, string $lat2, string $lon2, string $unit = "K"): string
    {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0;
        }
        else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit = strtoupper($unit);

            if ($unit == "K") {
                return ($miles * 1.609344);
            } else if ($unit == "N") {
                return ($miles * 0.8684);
            } else {
                return $miles;
            }
        }
    }

    public function distanceBetweenIpAddressAndPostalAddress(string $postalAddress, string $ipAddress): string
    {
        $longLatForPostalAddress = $this->getLongitudeLatitudeFromPostalAddress($postalAddress);

        $longLatForIpAddress = $this->getLongitudeLatitudeFromIpAddress($ipAddress);

        return $this->distance(
            $longLatForPostalAddress['lat'],
            $longLatForPostalAddress['lon'],
            $longLatForIpAddress['lat'],
            $longLatForIpAddress['lon']
        );
    }

}