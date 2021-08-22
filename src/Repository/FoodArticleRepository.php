<?php

namespace App\Repository;

use App\Entity\FoodArticle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FoodArticle|null find($id, $lockMode = null, $lockVersion = null)
 * @method FoodArticle|null findOneBy(array $criteria, array $orderBy = null)
 * @method FoodArticle[]    findAll()
 * @method FoodArticle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FoodArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FoodArticle::class);
    }

    // /**
    //  * @return FoodArticle[] Returns an array of FoodArticle objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FoodArticle
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
