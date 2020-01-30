<?php

namespace App\Controller;

use App\Service\AddressService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\CalculateDistanceType;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class DefaultController extends ParentController
{
    /** @var AddressService */
    private $addressService;

    /**
     * DefaultController constructor.
     */
    public function __construct(AddressService $addressService)
    {
        $this->addressService = $addressService;
    }


    /**
     * @Route("/default", name="default")
     */
    public function index(Request $request)
    {
        $form = $this->createForm(CalculateDistanceType::class);

        if($request->isXmlHttpRequest()) {

            $form->handleRequest($request);

            if ($form->isValid()) {

                $distance = $this->addressService->getDistance(
                    $form['postal_address']->getData(),
                    $form['ip_address']->getData()
                );

                return new JsonResponse(['distance' => $distance]);
            } else {
                return new JsonResponse($this->getErrorsFromForm($form), Response::HTTP_BAD_REQUEST);
            }
        }

        return $this->render(
            'default/index.html.twig',
            [
                'controller_name' => 'DefaultController',
                'form' => $form->createView()
            ]
        );
    }

    /**
     * @Route("/ping", name="ping")
     */
    public function ping(Request $request)
    {
        return new JsonResponse('PONG FRONT');
    }
}
  