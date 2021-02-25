<?php

namespace App\Repository;

use App\Entity\ArcticleCommande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ArcticleCommande|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArcticleCommande|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArcticleCommande[]    findAll()
 * @method ArcticleCommande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArcticleCommandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArcticleCommande::class);
    }

    // /**
    //  * @return ArcticleCommande[] Returns an array of ArcticleCommande objects
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
    public function findOneBySomeField($value): ?ArcticleCommande
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
