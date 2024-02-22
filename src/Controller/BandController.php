<?php

namespace App\Controller;

use App\Entity\Band;
use App\Repository\BandRepository;
use App\Service\BandManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BandController extends AbstractController
{
    #[Route('/', name: 'list', methods: ['GET'])]
    public function index(BandRepository $bandRepository): JsonResponse
    {
        return new JsonResponse($bandRepository->findAll());
    }

    #[Route('/create', name: 'create', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $em, BandManager $bandManager): JsonResponse
    {
        $object = json_decode($request->getContent());

        $band = new Band();

        $errorsList = $bandManager->fillDataAndApplyVerifications($object, $band);

        if ($errorsList) {
            return new JsonResponse($errorsList, Response::HTTP_BAD_REQUEST);
        }

        $em->persist($band);
        $em->flush();

        return new JsonResponse('Saved new product with id ' . $band->getId());
    }

    #[Route('/{id}', name: 'read', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function read(int $id, BandManager $bandManager): JsonResponse
    {
        return new JsonResponse($bandManager->fetchAndCheckBandById($id));
    }

    #[Route('/update/{id}', name: 'update', methods: ['PUT'], requirements: ['id' => '\d+'])]
    public function update(
        int $id,
        Request $request,
        BandManager $bandManager,
        EntityManagerInterface $em
    ): JsonResponse {
        $band = $bandManager->fetchAndCheckBandById($id);

        $errorsList = $bandManager->fillDataAndApplyVerifications(json_decode($request->getContent()), $band);

        if ($errorsList) {
            return new JsonResponse($errorsList, Response::HTTP_BAD_REQUEST);
        }

        $em->flush();

        return new JsonResponse();
    }

    #[Route('/delete/{id}', name: 'delete', methods: ['DELETE'], requirements: ['id' => '\d+'])]
    public function delete(int $id, BandManager $bandManager, EntityManagerInterface $em): JsonResponse
    {
        $band = $bandManager->fetchAndCheckBandById($id);

        $em->remove($band);
        $em->flush();

        return new JsonResponse('Band has been deleted');
    }
}