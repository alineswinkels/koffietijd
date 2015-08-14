<?php

namespace FH\Bundle\AppBundle\Entity;

/**
 * @author Bart van Amelsvoort <bart@freshheads.com>
 */
class Consumption
{
    private $id;

    private $createdAt;

    private $fetcher;

    private $receiver;

    public function __construct(User $fetcher, User $receiver)
    {
        $this->fetcher = $fetcher;
        $this->receiver = $receiver;
        $this->createdAt = new \DateTime();
    }
}
