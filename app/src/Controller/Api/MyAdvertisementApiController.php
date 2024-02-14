<?php
namespace App\Controller\Api;

use App\Service\MyAdvertisementService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api', name: 'api_myadvertisement_')]
class MyAdvertisementApiController extends AbstractController
{
    public function __construct(
        private readonly MyAdvertisementService $advertisementService
    ){}

    #[Route('/my-advertisements/{advertisementId}', name: 'list', requirements: ['advertisementId' => '\d+'])]
    public function myAdvertisements(int $advertisementId): JsonResponse
    {
        return $this->json(
            $this->advertisementService->getAllMyActiveAdvertisements($advertisementId)
        );
    }
}