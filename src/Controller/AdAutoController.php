<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Entity\AdAuto;
use App\Repository\AdAutoRepository;
use App\Repository\AdRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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
    public function getAdAutoDetails(Ad $ad, SerializerInterface $serializer): JsonResponse
    {
        $jsonAd = $serializer->serialize($ad, 'json', ['groups' => 'getDetails']);

        return new JsonResponse($jsonAd, Response::HTTP_OK, ['accept' => 'json'], true);
    }

    #[Route('api/autos', name: 'add_ad_auto', methods: ['POST'])]
    public function addAdAuto(Request $request, SerializerInterface $serializer, EntityManagerInterface $em): JsonResponse
    {
        $adAuto = $serializer->deserialize($request->getContent(), AdAuto::class, 'json');
        $content = $request->toArray();
        $ad = new Ad();
        $ad->setTitle($content['title']);
        $ad->setContent($content['content']);
        $adAuto->setAd($ad);

        $em->persist($ad);
        $em->persist($adAuto);
        $em->flush();

        $json = $serializer->serialize($ad, 'json', ['groups' => 'getDetails']);

        return new JsonResponse($json, Response::HTTP_OK, ['accept' => 'json'], true);
    }

    #[Route('api/autos', name: 'update_ad_auto', methods: ['PUT'])]
    public function updateAdAuto(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, AdRepository $adRepository): JsonResponse
    {
        $content = $request->toArray();

        $ad = $adRepository->find($content["id"]);

        $ad->setTitle($content['title']);
        $ad->setContent($content['content']);

        $adAuto = $ad->getAdAuto();
        $adAuto->setBrand($content['brand']);
        $adAuto->setModel($content['model']);

        $em->persist($ad);
        $em->persist($adAuto);
        $em->flush();

        $json = $serializer->serialize($ad, 'json', ['groups' => 'getDetails']);

        return new JsonResponse($json, Response::HTTP_OK, ['accept' => 'json'], true);
    }
}
