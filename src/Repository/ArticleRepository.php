<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    // /**
    //  * @return Article[] Returns an array of Article objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Article
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


    /**
     * Retourne une liste d'infos concernant les articles pour les admins
     * (slug, titre, publié)
     */
    public function getArticlesAdminList (): array
    {
        $dql = $this->createQueryBuilder('a')
            ->select('a.slug, a.title, a.published')
            ->orderBy('a.createdAt', 'DESC');

        $query = $dql->getQuery();

        return $query->execute();
    }

    /**
     * Retourne une liste d'infos concernant les articles pour les utilisateurs
     * (slug, titre, image, extrait)
     */
    public function getArticlesList (): array
    {
        $dql = $this->createQueryBuilder('a')
            ->select('a.slug, a.title')
            ->where('a.published = 1')
            ->orderBy('a.createdAt', 'DESC');

        $query = $dql->getQuery();

        return $query->execute();
    }

    /**
     * Retourne une liste d'infos concernant les articles pour les utilisateurs
     * à utiliser dans la colonne de navigation
     * (slug, titre)
     */
    public function getArticlesNavigationList (): array
    {
        $dql = $this->createQueryBuilder('a')
            ->select('a.slug, a.title')
            ->where('a.published = 1')
            ->orderBy('a.createdAt', 'DESC')
            ->setMaxResults(3);

        $query = $dql->getQuery();

        return $query->execute();
    }
}
