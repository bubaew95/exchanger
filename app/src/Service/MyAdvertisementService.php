<?php

namespace App\Service;

use App\Entity\Advertisement;
use App\Entity\ExchangeOffers;
use App\Entity\User;
use App\Model\MyAdvertisementResponse;
use App\Repository\AdvertisementRepository;
use App\Repository\ExchangeOffersRepository;
use Symfony\Bundle\SecurityBundle\Security;

readonly class MyAdvertisementService
{
    public function __construct(
        private AdvertisementRepository $repository,
        private Security $security
    ) {}

    public function getAllMyActiveAdvertisements(int $advertisementId): ?array
    {
        /** @var User $user */
        $user = $this->security->getUser();
        $advertisements = $this->repository->findAllMyActiveAdvertisements($user, $advertisementId);

        return array_map(fn(Advertisement $advertisement) => new MyAdvertisementResponse(
            $advertisement->getId(),
            $advertisement->getName(),
            $advertisement->getSlug(),
            $advertisement->getSeoDescription(),
            $advertisement->getImages()[0]?->getImage(),
            $advertisement->getProposedAdvertisement()->map(function (ExchangeOffers $item) use ($advertisement, $advertisementId) {
                return $item->getProposedAdvertisement()->getId() === $advertisement->getId()
                    && $item->getAdvertisement()->getId() ===  $advertisementId;
            })[0] ?? false
        ), $advertisements);
    }
}