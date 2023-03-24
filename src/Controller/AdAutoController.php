<?php

namespace App\Controller;

use App\Entity\AdAuto;
use App\Repository\AdAutoRepository;
use App\Repository\AdRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface; 


class AdAutoController extends AbstractController
{
    #[Route('api/autos', name: 'ad_auto_list', methods: ['GET'])]
    public function getAdAutoList(AdRepository $adAutoRepository, SerializerInterface $serializer): JsonResponse
    {
        $adAutoList = $adAutoRepository->findAll();
        $jsonAdAutoList = $serializer->serialize($adAutoList, 'json', ['groups' => 'getList']);

        return new JsonResponse($jsonAdAutoList, Response::HTTP_OK, [], true);
    }

    #[Route('api/autos/{id}', name: 'ad_auto_details', methods: ['GET'])]
    public function getAdAutoDetails(int $id, AdRepository $adAutoRepository): JsonResponse
    {
        $adAuto = $adAutoRepository->find($id);

        return new JsonResponse($adAuto->getId(), Response::HTTP_OK, [], true);
    }
}
