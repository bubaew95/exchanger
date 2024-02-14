<?php

namespace App\Controller\Api;

use App\Entity\Advertisement;
use App\Model\ResponseId;
use App\Service\OfferService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api')]
class OfferApiController extends AbstractController
{
    #[Route('/offer/add/{id}/{proposedId}', requirements: ['id' => '\d+', 'proposedId' => '\d+'])]
    public function offer(int $id, int $proposedId, OfferService $offerService): JsonResponse
    {
        $offerService->offerAdd($id, $proposedId);

        return $this->json(new ResponseId($proposedId));
    }

    #[Route('/offer/delete/{id}/{proposedId}', requirements: ['id' => '\d+', 'proposedId' => '\d+'])]
    public function deleteOffer(int $id, int $proposedId, OfferService $offerService): JsonResponse
    {
        $offerService->offerDelete($id, $proposedId);
        return $this->json(new ResponseId($proposedId));
    }
}