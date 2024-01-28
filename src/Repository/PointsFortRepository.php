<?php

namespace App\Repository;

use App\Entity\PointsFort;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PointsFort>
 *
 * @method PointsFort|null find($id, $lockMode = null, $lockVersion = null)
 * @method PointsFort|null findOneBy(array $criteria, array $orderBy = null)
 * @method PointsFort[]    findAll()
 * @method PointsFort[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PointsFortRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PointsFort::class);
    }

//    /**
//     * @return PointsFort[] Returns an array of PointsFort objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PointsFort
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
