<?php

namespace App\Repository;

use App\Entity\ExchangeOffers;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ExchangeOffers>
 *
 * @method ExchangeOffers|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExchangeOffers|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExchangeOffers[]    findAll()
 * @method ExchangeOffers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExchangeOffersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExchangeOffers::class);
    }

    public function getOffersByAdvertisementId(User|int $user, int $advertisementId)
    {
        return $this->findAllOffers()
            ->andWhere('eo.advertisement = :advertisementId')
            ->andWhere('eo.user = :user')
            ->andWhere('eo.choosed IS NULL')
            ->setParameters([
                'advertisementId' => $advertisementId,
                'user' => $user
            ])
            ->getQuery()
            ->getResult()
        ;
    }

    public function getProposedAdvertisements(int $advertisementId): ?array
    {
        return $this->findAllOffers(withProposedAdvertisement: true)
            ->andWhere('eo.advertisement = :id')
            ->setParameter('id', $advertisementId)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findOfferWithProposeIdAndAdvId(int $proposeId, int $advertisementId): ?ExchangeOffers
    {
        return $this->findAllOffers(withAdvertisement: true, withProposedAdvertisement: true)
            ->andWhere('eo.advertisement = :advertisementId')
            ->andWhere('eo.proposed_advertisement = :proposeId')
            ->andWhere('eo.choosed IS NULL')
            ->setParameters([
                'advertisementId' => $advertisementId,
                'proposeId' => $proposeId
            ])
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    private function findAllOffers(
        $withAdvertisement = false,
        $withProposedAdvertisement = false
    ): QueryBuilder
    {
        $queryBuilder = $this->createQueryBuilder('eo');

        if($withAdvertisement) {
            $queryBuilder
                ->addSelect('a')
                ->innerJoin('eo.advertisement', 'a')
            ;
        }

        if($withProposedAdvertisement) {
            $queryBuilder
                ->addSelect('pa, i')
                ->innerJoin('eo.proposed_advertisement', 'pa')
                ->leftJoin('pa.images', 'i',  Join::WITH, 'i.base IS NOT NULL');
            ;
        }

        return $queryBuilder;
    }

}
