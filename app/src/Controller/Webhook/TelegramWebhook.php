<?php

namespace App\Controller\Webhook;

use App\Model\TelegramCallbackQueryRequest;
use App\Service\Telegram\TelegramCallbackService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/webhook/telegram')]
class TelegramWebhook extends AbstractController
{
    #[Route(methods: ['POST'])]
    public function init(#[MapRequestPayload]
        TelegramCallbackQueryRequest $imagesRequest,
        TelegramCallbackService $callbackService
    ): JsonResponse
    {
        return $this->json($callbackService->init($imagesRequest));
    }
}