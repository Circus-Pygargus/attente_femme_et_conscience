<?php

namespace App\Repository;

use App\Entity\NewslettersUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NewslettersUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method NewslettersUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method NewslettersUser[]    findAll()
 * @method NewslettersUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NewslettersUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NewslettersUser::class);
    }

    // /**
    //  * @return NewslettersUser[] Returns an array of NewslettersUser objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NewslettersUser
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
