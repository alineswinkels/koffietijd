<?php

namespace FH\Bundle\AppBundle\Session;

/**
 * @author Bart van Amelsvoort <bart@freshheads.com>
 */
class CurrentSession
{
    /**
     * @var \DateTime
     */
    private $startedAt;

    /**
     * @param \DateTime $startedAt
     */
    public function __construct(\DateTime $startedAt)
    {
        $this->startedAt = $startedAt;
    }

    public function getSecondsLeft()
    {
        $endsAt = clone $this->startedAt;
        $endsAt->modify('+35 seconds');

        return max(0, $endsAt->getTimestamp() - time());
    }
}
