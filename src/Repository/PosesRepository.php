<?php

namespace App\Repository;

use App\Entity\Poses;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Poses>
 *
 * @method Poses|null find($id, $lockMode = null, $lockVersion = null)
 * @method Poses|null findOneBy(array $criteria, array $orderBy = null)
 * @method Poses[]    findAll()
 * @method Poses[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PosesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Poses::class);
    }

//    /**
//     * @return Poses[] Returns an array of Poses objects
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

//    public function findOneBySomeField($value): ?Poses
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
