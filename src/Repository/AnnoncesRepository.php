<?php

namespace App\Repository;

use App\Entity\Annonces;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Annonces>
 */
class AnnoncesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Annonces::class);
    }

      public function findBySearchCriteria(array $criteria): array
    {
        $qb = $this->createQueryBuilder('a')
            ->join('a.propertys', 'p')
            ->join('p.categorysbien', 'c')
            ->join('p.typesbien', 't')
            ->join('p.adresses', 'ad')
            ->addSelect('p', 'c', 't', 'ad');

        if (!empty($criteria['category'])) {
            $qb->andWhere('c.id = :category')
                ->setParameter('category', $criteria['category']);
        }

        if (!empty($criteria['type'])) {
            $qb->andWhere('t.id = :type')
                ->setParameter('type', $criteria['type']);
        }

        if (!empty($criteria['minSurface'])) {
            $qb->andWhere('p.surface >= :minSurface')
                ->setParameter('minSurface', $criteria['minSurface']);
        }

        if (!empty($criteria['maxSurface'])) {
            $qb->andWhere('p.surface <= :maxSurface')
                ->setParameter('maxSurface', $criteria['maxSurface']);
        }

        if (!empty($criteria['minPrix'])) {
            $qb->andWhere('p.prix >= :minPrix')
                ->setParameter('minPrix', $criteria['minPrix']);
        }

        if (!empty($criteria['maxPrix'])) {
            $qb->andWhere('p.prix <= :maxPrix')
                ->setParameter('maxPrix', $criteria['maxPrix']);
        }

        if (!empty($criteria['ville'])) {
            $qb->andWhere('ad.ville LIKE :ville')
                ->setParameter('ville', '%' . $criteria['ville'] . '%');
        }

        return $qb->getQuery()->getResult();
    }



    //    /**
    //     * @return Annonces[] Returns an array of Annonces objects
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

    //    public function findOneBySomeField($value): ?Annonces
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
