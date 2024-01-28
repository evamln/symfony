<?php

namespace App\Repository;

use App\Entity\Pouvoirs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Pouvoirs>
 *
 * @method Pouvoirs|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pouvoirs|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pouvoirs[]    findAll()
 * @method Pouvoirs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PouvoirsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pouvoirs::class);
    }

//    /**
//     * @return Pouvoirs[] Returns an array of Pouvoirs objects
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

//    public function findOneBySomeField($value): ?Pouvoirs
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
