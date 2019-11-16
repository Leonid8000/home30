<?php

namespace App\Repository;

use App\Entity\Que;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Que|null find($id, $lockMode = null, $lockVersion = null)
 * @method Que|null findOneBy(array $criteria, array $orderBy = null)
 * @method Que[]    findAll()
 * @method Que[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Que::class);
    }

    // /**
    //  * @return Que[] Returns an array of Que objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Que
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
