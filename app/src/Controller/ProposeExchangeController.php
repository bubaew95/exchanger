<?php

namespace App\Controller;

use App\Entity\Advertisement;
use App\Service\OfferService;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Attribute\Route;

class ProposeExchangeController extends BaseController
{
    #[Route('/advertisement/add/offer/{id}/{proposedId}', name: 'app_exchange_propose')]
    public function offer(int $proposedId, Advertisement $advertisement, OfferService $offerService):  RedirectResponse
    {
        $currentRequest = $this->requestStack->getCurrentRequest();
        $offerService->offerAdd($advertisement, $proposedId);

        return $this->redirect($currentRequest->server->get('HTTP_REFERER'));
    }
}