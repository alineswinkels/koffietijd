<?php

namespace FH\Bundle\AppBundle\Entity;

/**
 * @author Bart van Amelsvoort <bart@freshheads.com>
 */
class User
{
    private $id;

    private $firstName;

    private $surname;

    private $code;

    private $image;

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

    /**
     * @return string
     */
    public function getImagePath()
    {
        return sprintf('img/%s', $this->image);
    }
}
