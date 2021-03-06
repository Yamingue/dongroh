<?php

namespace App\Repository;

use App\Entity\NoteArticle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NoteArticle|null find($id, $lockMode = null, $lockVersion = null)
 * @method NoteArticle|null findOneBy(array $criteria, array $orderBy = null)
 * @method NoteArticle[]    findAll()
 * @method NoteArticle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NoteArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NoteArticle::class);
    }

    // /**
    //  * @return NoteArticle[] Returns an array of NoteArticle objects
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
    public function findOneBySomeField($value): ?NoteArticle
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
