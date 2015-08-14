<?php

namespace FH\Bundle\AppBundle\Entity;

use Symfony\Component\Security\Core\Role\Role;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @author Bart van Amelsvoort <bart@freshheads.com>
 */
class User
{
    private $id;

    private $firstName;

    private $surname;

    private $code;

    public function __toString()
    {
        return (string) $this->getName();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->firstName . ' ' . $this->surname;
    }
}
