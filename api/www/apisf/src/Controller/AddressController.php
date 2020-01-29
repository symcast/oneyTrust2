<?php

namespace App\Controller;

use App\Service\AddressService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddressController extends AbstractController
{
    /** @var AddressService */
    private $addressService;

    public function __construct(AddressService $addressService)
    {
        $this->addressService = $addressService;
    }

    /**
     * @Route("/", name="default")
     */
    public function index(Request $request)
    {
        $content = $request->request->all();
        $distance =  $this->addressService->distanceBetweenIpAddressAndPostalAddress(
            $content["postalAddress"],
            $content["ipAddress"]
        );

        return new Response($distance, 200, ['content-type' => 'application/json']);
    }

    /**
     * @Route("/ping", name="ping")
     */
    public function ping(Request $request)
    {
        return new JsonResponse('PONG API');
    }
}
