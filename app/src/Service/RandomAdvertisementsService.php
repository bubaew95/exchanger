<?php

namespace App\Service;

use App\Repository\AdvertisementRepository;

readonly class RandomAdvertisementsService
{
    public function __construct(
        private AdvertisementRepository $advertisementRepository
    ) {}

    public function advertisements(): ?array
    {
        return $this->advertisementRepository->getRandomAdvertisements();
    }
}