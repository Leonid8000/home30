<?php

namespace App\Repository;

use App\Entity\Ans;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Ans|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ans|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ans[]    findAll()
 * @method Ans[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ans::class);
    }

    // /**
    //  * @return Ans[] Returns an array of Ans objects
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
    public function findOneBySomeField($value): ?Ans
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
