<?php

namespace App\Service;

use App\Entity\Advertisement;
use App\Entity\ExchangeOffers;
use App\EventSubscriber\Listener\AdvertisementListener;
use App\Exception\OfferIsExistsException;
use App\Exception\OfferUserMismatchException;
use App\Repository\AdvertisementRepository;
use App\Repository\ExchangeOffersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

readonly class OfferService
{
    public function __construct(
        private ExchangeOffersRepository $exchangeOffersRepository,
        private AdvertisementRepository  $advertisementRepository,
        private EntityManagerInterface   $em,
        private Security                 $security,
        private EventDispatcherInterface $dispatcher
    ) {}

    public function offerAdd(Advertisement|int $advertisementId, int $proposedAdvertisementId): void
    {
        $advertisement = $this->advertisementRepository->find($advertisementId);
        $proposedAdvertisement = $this->advertisementRepository->findAdvertisementById($proposedAdvertisementId);

        if(!!$this->offerWithAdvertisement($advertisement, $proposedAdvertisement)) {
            throw new OfferIsExistsException();
        }

        $exchange = (new ExchangeOffers())
            ->setAdvertisement($advertisement)
            ->setProposedAdvertisement($proposedAdvertisement)
            ->setUser($this->security->getUser())
        ;

        $this->em->persist($exchange);
        $this->em->flush();

        $this->dispatcher->dispatch(new AdvertisementListener($advertisement, $proposedAdvertisement, 'create'));
    }

    public function offerDelete(int $advertisementId, int $proposeId) : void
    {
        $offer = $this->offerWithAdvertisement($advertisementId, $proposeId);

        if(null === $offer) {
            throw new NotFoundHttpException('Офер не найден.');
        }

        if($offer->getUser() !== $this->security->getUser()) {
            throw new OfferUserMismatchException();
        }

        $this->dispatcher->dispatch(new AdvertisementListener($offer->getAdvertisement(), $offer->getProposedAdvertisement(), 'delete'));

        $this->em->remove($offer);
        $this->em->flush();
    }

    public function offerWithAdvertisement(Advertisement|int $advertisement, Advertisement|int $proposeOffer) : ?ExchangeOffers
    {
        return $this->exchangeOffersRepository->findOneBy([
            'advertisement' => $advertisement,
            'proposed_advertisement' => $proposeOffer
        ]);
    }
}