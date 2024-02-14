<?php

namespace App\EventSubscriber;

use App\EventSubscriber\Listener\AdvertisementListener;
use App\Service\Telegram\SendPhotoService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

readonly class ProposedAdvertisementSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private SendPhotoService $photoService
    ){}

    public function onKernelController(AdvertisementListener $event): void
    {
        $advertisement = $event->getAdvertisement();
        $proposedAdvertisement = $event->getProposedAdvertisement();

        switch ($event->getAction()) {
            case 'create':
                $this->photoService->createNotifier($advertisement, $proposedAdvertisement);
            break;
            case 'delete':
                $this->photoService->deleteNotifier($advertisement, $proposedAdvertisement);
                break;
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            AdvertisementListener::class => 'onKernelController',
        ];
    }
}
