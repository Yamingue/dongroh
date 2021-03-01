<?php

namespace App\Repository;

use App\Entity\CheckOut;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CheckOut|null find($id, $lockMode = null, $lockVersion = null)
 * @method CheckOut|null findOneBy(array $criteria, array $orderBy = null)
 * @method CheckOut[]    findAll()
 * @method CheckOut[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CheckOutRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CheckOut::class);
    }

    // /**
    //  * @return CheckOut[] Returns an array of CheckOut objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CheckOut
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
