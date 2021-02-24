<?php

namespace App\Repository;

use App\Entity\FormationVideo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FormationVideo|null find($id, $lockMode = null, $lockVersion = null)
 * @method FormationVideo|null findOneBy(array $criteria, array $orderBy = null)
 * @method FormationVideo[]    findAll()
 * @method FormationVideo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormationVideoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FormationVideo::class);
    }

    // /**
    //  * @return FormationVideo[] Returns an array of FormationVideo objects
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
    public function findOneBySomeField($value): ?FormationVideo
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findAllPaginate()
    {
        return $this->createQueryBuilder('f')
            ->orderBy('f.id', 'DESC')
            ->getQuery()
        ;
    }
}
