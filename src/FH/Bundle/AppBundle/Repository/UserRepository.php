<?php

namespace FH\Bundle\AppBundle\Repository;

use FH\Bundle\AppBundle\Entity\User;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\EntityManager;

/**
 * @author Bart van Amelsvoort <bart@freshheads.com>
 */
class UserRepository
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function findOneById($id)
    {
        return $this->createBaseQueryBuilder()
            ->andWhere('u.id = :id')
            ->setParameter('id', $id)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param string $code
     * @return mixed
     */
    public function findOneByCode($code)
    {
        return $this->createBaseQueryBuilder()
            ->andWhere('u.code = :code')
            ->setParameter('code', $code)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param User $user
     * @return User[]
     */
    public function findAllExceptUser(User $user)
    {
        return $this->createBaseQueryBuilder()
            ->andWhere('u != :user')
            ->setParameter('user', $user)
            ->orderBy('u.firstName, u.surname')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return User[]
     */
    public function getTopFetchers()
    {
        return $this->createBaseQueryBuilder()
            ->select('u, COUNT(cf) as fetched_count')
            ->innerJoin('u.consumptionsFetched', 'cf')
            ->groupBy('u')
            ->orderBy('fetched_count', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return User[]
     */
    public function getTopReceivers()
    {
        return $this->createBaseQueryBuilder()
            ->select('u, COUNT(cr) as received_count')
            ->innerJoin('u.consumptionsReceived', 'cr')
            ->groupBy('u')
            ->orderBy('received_count', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return User[]
     */
    public function getTopQuestionResults()
    {
        return $this->createBaseQueryBuilder()
            ->select('u, SUM(qa.correct) as total_score')
            ->innerJoin('u.questionAnswers', 'qa')
            ->groupBy('u')
            ->orderBy('total_score', 'DESC')
            ->having('total_score > 0')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return QueryBuilder
     */
    private function createBaseQueryBuilder()
    {
        return $this->entityManager
            ->getRepository('FH\Bundle\AppBundle\Entity\User')
            ->createQueryBuilder('u');
    }
}
