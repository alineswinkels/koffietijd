<?php

namespace FH\Bundle\AppBundle\User;

use FH\Bundle\AppBundle\Entity\User;
use Symfony\Component\Security\Core\Authentication\AuthenticationManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

/**
 * @author Bart van Amelsvoort <bart@freshheads.com>
 */
class LoginUser
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var AuthenticationManagerInterface
     */
    private $authenticationManager;

    /**
     * @param TokenStorageInterface $tokenStorage
     * @param AuthenticationManagerInterface $authenticationManager
     */
    public function __construct(TokenStorageInterface $tokenStorage, AuthenticationManagerInterface $authenticationManager)
    {
        $this->tokenStorage = $tokenStorage;
        $this->authenticationManager = $authenticationManager;
    }

    /**
     * @param User $user
     */
    public function login(User $user)
    {
        $token = new UsernamePasswordToken($user, $user->getCode(), 'frontend', [ 'ROLE_USER' ]);

        $this->tokenStorage->setToken($token);
    }
}
