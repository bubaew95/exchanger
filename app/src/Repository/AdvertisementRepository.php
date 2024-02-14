<?php

namespace App\Repository;

use App\Entity\Advertisement;
use App\Entity\User;
use App\Enum\AdvertisementStatus;
use App\Exception\AdvertisementNotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\Query;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Advertisement>
 *
 * @method Advertisement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Advertisement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Advertisement[]    findAll()
 * @method Advertisement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdvertisementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Advertisement::class);
    }

    public function findAdvertisementById(int $id): ?Advertisement
    {
        return $this->findWithAllQuery(
            withImage: true,
            withSeller: true,
        )
            ->andWhere('a.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function findAdvertisementBySlug(string $slug): ?Advertisement
    {
        $advertisement = $this->findWithAllQuery(
                withImages: true,
                withSeller: true,
            )
            ->andWhere('a.slug = :slug')
            ->andWhere('a.status = 1')
            ->setParameter('slug', $slug)
            ->getQuery()
            ->getOneOrNullResult()
        ;

        if(null === $advertisement) {
            throw new AdvertisementNotFoundException();
        }

        return $advertisement;
    }

    public function getAdvertisementsQuery() : Query
    {
        return $this->findWithAllQuery(withImage: true)
            ->where('a.status = 1')
            ->getQuery()
        ;
    }

    public function getAdvertisementsLimit(int $limit = 8): ?array
    {
        return $this->findWithAllQuery(withImage: true)
            ->setMaxResults($limit)
            ->orderBy('a.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findAllMyActiveAdvertisements(User|int $user, Advertisement|int $advertisement, $status = AdvertisementStatus::ACTIVE): ?array
    {
        return $this->findWithAllQuery(withImage: true)
            ->addSelect('pa')
                ->leftJoin('a.proposedAdvertisement', 'pa', 'WITH', 'pa.advertisement = :advertisementId')
                    ->setParameter('advertisementId', $advertisement)
            ->andWhere('a.user = :user')
                ->setParameter('user', $user)
            ->andWhere('a.status = :status')
                ->setParameter('status', $status)
            ->andWhere('pa.choosed IS NULL')
            ->orderBy('a.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function getRandomAdvertisements(int $limit = 8): ?array
    {
        return $this->findWithAllQuery(withImage: true)
            ->setMaxResults($limit)
            ->orderBy('RAND()')
            ->getQuery()
            ->getResult()
        ;
    }

    private function findWithAllQuery(
        $withImage = false,
        $withImages = false,
        $withSeller = false,
        $withPropose = false,
    ) : QueryBuilder
    {
        $queryBuilder = $this->createQueryBuilder('a');

        if($withImages || $withImage) {
            $queryBuilder
                ->addSelect('i')
            ;

            if($withImage) {
                $queryBuilder->leftJoin('a.images', 'i',  Join::WITH, 'i.base IS NOT NULL');
            } else {
                $queryBuilder->leftJoin('a.images', 'i');
            }
        }

        if($withSeller) {
            $queryBuilder
                ->addSelect('u')
                ->innerJoin('a.user', 'u')
            ;
        }

        if($withPropose) {
            $queryBuilder
                ->addSelect('pa')
                ->leftJoin('a.proposedAdvertisement', 'pa')
            ;
        }

        return $queryBuilder;
    }
}
