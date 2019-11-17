<?php

namespace App\Repository;

use App\Entity\Survey;
use App\Entity\SurveyAnswer;
use App\Entity\SurveyQuestion;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SurveyQuestion|null find($id, $lockMode = null, $lockVersion = null)
 * @method SurveyQuestion|null findOneBy(array $criteria, array $orderBy = null)
 * @method SurveyQuestion[]    findAll()
 * @method SurveyQuestion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SurveyQuestionsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SurveyQuestion::class);
    }

    public function findUnansweredQuestions(Survey $survey, User $user)
    {

        $subQ = $this->_em->createQueryBuilder()->select('qst.id')
            ->from(SurveyAnswer::class, 'answ')
            ->leftJoin(SurveyQuestion::class, 'qst', 'WITH', 'qst.id=answ.question')
            ->where('qst.survey = :survey')->andWhere('answ.user = :user');
        $q = $this->createQueryBuilder('q');
        $q->where($q->expr()->notIn('q.id', $subQ->getDQL()))->andWhere('q.survey = :survey2')
            ->setParameter('user', $user)
            ->setParameter('survey', $survey)
            ->setParameter('survey2', $survey)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults($survey->getQuestionsPerPage());

        return $q->getQuery();
    }
}
