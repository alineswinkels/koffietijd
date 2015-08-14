<?php

namespace FH\Bundle\AppBundle\Repository;

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
     * @return QueryBuilder
     */
    private function createBaseQueryBuilder()
    {
        return $this->entityManager
            ->getRepository('FH\Bundle\AppBundle\Entity\User')
            ->createQueryBuilder('u');
    }
}
