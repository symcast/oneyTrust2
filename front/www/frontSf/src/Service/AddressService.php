<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class AddressService
{
    /**  @var HttpClientInterface */
    private $httpClient;

    /** @var string */
    private $apiAddress;

    public function __construct(HttpClientInterface $httpClient, $apiAddress)
    {
        $this->httpClient = $httpClient;
        $this->apiAddress = $apiAddress;
    }

    public function getDistance(string $postalAddress, string $ipAddress)
    {
        $response = $this->httpClient->request(
            Request::METHOD_POST,
            $this->apiAddress,
            [
                'body' => [
                    'postalAddress' =>  $postalAddress,
                    'ipAddress' =>  $ipAddress
                ],
            ]
        );

        return $response->getContent();
        
    }
    
}