<?php

namespace App\Service;

use App\Entity\Advertisement;
use App\Repository\AdvertisementRepository;
use App\Repository\ExchangeOffersRepository;
use Knp\Component\Pager\Pagination\PaginationInterface;

readonly class AdvertisementService
{
    public function __construct(
        private AdvertisementRepository  $advertisementRepository,
        private ExchangeOffersRepository $exchangeOffersRepository,
        private PaginationService        $paginationService
    ){}

    public function getAdvertisement(): PaginationInterface
    {
        $queryBuilder = $this->advertisementRepository->getAdvertisementsQuery();

        return $this->paginationService->paginate($queryBuilder);
    }

    public function getAdvertisementDetails(string $slug): ?Advertisement
    {
        return $this->advertisementRepository->findAdvertisementBySlug($slug);
    }

    public function getAdvertisementOffers(int $id): ?array
    {
        return $this->exchangeOffersRepository->getProposedAdvertisements($id);
    }

    public function lastAdvertisements(int $limit = 8): ?array
    {
        return $this->advertisementRepository->getAdvertisementsLimit($limit);
    }
}