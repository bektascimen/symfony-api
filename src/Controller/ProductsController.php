<?php

namespace App\Controller;

use App\Dto\LowestPriceEnquiry;
use App\Filter\Contracts\PromotionsFilterInterface;
use App\Service\Serializer\Dtoserializer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductsController extends AbstractController
{
    #[Route('/products/{id}/lowest-price', name: 'lowest-price', methods: 'POST')]
    public function getLowestPrice(
        Request                   $request,
        Dtoserializer             $serializer,
        PromotionsFilterInterface $promotionsFilter
    ): Response
    {
        if ($request->headers->get('force_fail')) {
            return new JsonResponse([
                'error' => 'Request Error.'
            ], $request->headers->get('force_fail'));
        }

        /** @var LowestPriceEnquiry $lowestPriceEnquiry */
        $lowestPriceEnquiry = $serializer->deserialize($request->getContent(), LowestPriceEnquiry::class, 'json');

        $modifiedEnquiry = $promotionsFilter->apply($lowestPriceEnquiry);

        $response = $serializer->serialize($modifiedEnquiry, 'json');

        return new Response($response, 200);
    }

    #[Route('/products/{id}/promotions', name: 'promotions', methods: 'GET')]
    public function promotions()
    {

    }
}