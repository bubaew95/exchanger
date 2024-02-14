<?php

namespace App\Controller;

use App\Service\AdvertisementService;
use App\Service\RandomAdvertisementsService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdvertisementController extends BaseController
{
    #[Route('/advertisements', name: 'app_advertisement')]
    public function index(AdvertisementService $advertisementService): Response
    {
        return $this->render('advertisement/index.html.twig', [
            'pagination' => $advertisementService->getAdvertisement(),
        ]);
    }

    #[Route('/advertisement/{slug}', name: 'app_advertisement_details')]
    public function details(string $slug, AdvertisementService $advertisementService) : Response
    {
        $details = $advertisementService->getAdvertisementDetails($slug);
        $offers = $advertisementService->getAdvertisementOffers($details->getId());

        return $this->render('advertisement/details.html.twig', [
            'details' => $details,
            'offers' => $offers
        ]);
    }

    public function randAdvertisements(RandomAdvertisementsService $service): Response
    {
        return $this->render('advertisement/random-advertisements.html.twig', [
            'advertisements' => $service->advertisements()
        ]);
    }
}
