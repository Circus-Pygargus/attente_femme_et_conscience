<?php

namespace App\Repository;

use App\Entity\DistanceLearning;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DistanceLearning|null find($id, $lockMode = null, $lockVersion = null)
 * @method DistanceLearning|null findOneBy(array $criteria, array $orderBy = null)
 * @method DistanceLearning[]    findAll()
 * @method DistanceLearning[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DistanceLearningRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DistanceLearning::class);
    }

    // /**
    //  * @return DistanceLearning[] Returns an array of DistanceLearning objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DistanceLearning
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
