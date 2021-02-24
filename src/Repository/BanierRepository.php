<?php

namespace App\Repository;

use App\Entity\Banier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Banier|null find($id, $lockMode = null, $lockVersion = null)
 * @method Banier|null findOneBy(array $criteria, array $orderBy = null)
 * @method Banier[]    findAll()
 * @method Banier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BanierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Banier::class);
    }

    // /**
    //  * @return Banier[] Returns an array of Banier objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Banier
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
