<?php

namespace App\Repository;

use App\Entity\Survey;
use App\Entity\User;
use App\Entity\UserFinishedSurvey;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Survey|null find($id, $lockMode = null, $lockVersion = null)
 * @method Survey|null findOneBy(array $criteria, array $orderBy = null)
 * @method Survey[]    findAll()
 * @method Survey[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SurveyRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Survey::class);
    }

    public function getUnfinishedSurveys(User $user):Query
    {
        $subQ= $this->_em->createQueryBuilder()->select('ss.id')
            ->from(UserFinishedSurvey::class, 'uss')
            ->leftJoin(Survey::class,'ss','WITH','ss.id=uss.survey')
            ->where('uss.finished = true')->andWhere('uss.user = :user');
        $q=$this->createQueryBuilder('s');
        $q->where($q->expr()->notIn('s.id', $subQ->getDQL()))->setParameter('user',$user);
        return $q->getQuery();
    }

}
