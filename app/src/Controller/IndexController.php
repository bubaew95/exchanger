<?php

namespace App\Controller;

use App\Service\AdvertisementService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class IndexController extends BaseController
{
    #[Route('/', name: "app_index")]
    public function index(AdvertisementService $advertisementService) : Response
    {
        return $this->render('index/index.html.twig', [
            'lastAdvertisements' => $advertisementService->lastAdvertisements(12)
        ]);
    }
}