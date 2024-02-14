<?php

namespace App\EventSubscriber\Listener;

use App\Entity\Advertisement;

readonly class AdvertisementListener
{
    public function __construct(
        private Advertisement $advertisement,
        private Advertisement $proposedAdvertisement,
        private string $action
    ){}

    public function getAdvertisement(): ?Advertisement
    {
        return $this->advertisement;
    }

    public function getProposedAdvertisement(): Advertisement
    {
        return $this->proposedAdvertisement;
    }

    public function getAction(): string
    {
        return $this->action;
    }
}