<?php

namespace App\Repository;

use App\Entity\Meta;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\AbstractQuery;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Meta>
 *
 * @method Meta|null find($id, $lockMode = null, $lockVersion = null)
 * @method Meta|null findOneBy(array $criteria, array $orderBy = null)
 * @method Meta[]    findAll()
 * @method Meta[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MetaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Meta::class);
    }

    public function findMetaByUrl(string $url)
    {
        return $this->createQueryBuilder('m')
            ->where('m.url = :url')
            ->setParameter('url', $url)
            ->getQuery()
            ->getOneOrNullResult(AbstractQuery::HYDRATE_ARRAY)
        ;
    }
}
