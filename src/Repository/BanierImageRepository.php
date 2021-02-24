<?php

namespace App\Repository;

use App\Entity\BanierImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BanierImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method BanierImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method BanierImage[]    findAll()
 * @method BanierImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BanierImageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BanierImage::class);
    }

    // /**
    //  * @return BanierImage[] Returns an array of BanierImage objects
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
    public function findOneBySomeField($value): ?BanierImage
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
