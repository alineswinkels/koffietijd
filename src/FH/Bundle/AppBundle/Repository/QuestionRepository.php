<?php

namespace FH\Bundle\AppBundle\Repository;

use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\EntityManager;
use FH\Bundle\AppBundle\Entity\Question;

/**
 * @author Bart van Amelsvoort <bart@freshheads.com>
 */
class QuestionRepository
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
     * @return Question
     */
    public function findOneRandom()
    {
        return $this->createBaseQueryBuilder()
            ->orderBy('RAND()')
            ->setMaxResults(1)
            ->getQuery()
            ->getSingleResult();
    }

    /**
     * @return QueryBuilder
     */
    private function createBaseQueryBuilder()
    {
        return $this->entityManager
            ->getRepository('FH\Bundle\AppBundle\Entity\Question')
            ->createQueryBuilder('q');
    }
}
