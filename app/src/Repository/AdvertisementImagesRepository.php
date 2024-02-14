<?php

namespace App\Repository;

use App\Entity\AdvertisementImages;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AdvertisementImages>
 *
 * @method AdvertisementImages|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdvertisementImages|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdvertisementImages[]    findAll()
 * @method AdvertisementImages[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdvertisementImagesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AdvertisementImages::class);
    }

//    /**
//     * @return AdvertisementImages[] Returns an array of AdvertisementImages objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?AdvertisementImages
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
