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
     * @return QueryBuilder
     */
    private function createBaseQueryBuilder()
    {
        return $this->entityManager
            ->getRepository('FH\Bundle\AppBundle\Entity\User')
            ->createQueryBuilder('u');
    }
}
