<?php

namespace App\Repository;

use App\Entity\PresentialAccompaniment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PresentialAccompaniment|null find($id, $lockMode = null, $lockVersion = null)
 * @method PresentialAccompaniment|null findOneBy(array $criteria, array $orderBy = null)
 * @method PresentialAccompaniment[]    findAll()
 * @method PresentialAccompaniment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PresentialAccompanimentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PresentialAccompaniment::class);
    }

    // /**
    //  * @return PresentialAccompaniment[] Returns an array of PresentialAccompaniment objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PresentialAccompaniment
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     * Retourne une liste d'infos concernant les accompagnements en présentiel pour les admins
     * (slug, title, published)
     */
    public function getPresentialAccompanimentsAdminList (): array
    {
        $dql = $this->createQueryBuilder('d')
            ->select('d.slug, d.title, d.published')
            ->addOrderBy('d.createdAt', 'DESC');

        $query = $dql->getQuery();

        return $query->execute();
    }
}
