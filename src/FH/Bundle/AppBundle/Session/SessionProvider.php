<?php

namespace FH\Bundle\AppBundle\Session;

use Symfony\Component\HttpFoundation\Session\Session;

/**
 * @author Bart van Amelsvoort <bart@freshheads.com>
 */
class SessionProvider
{
    const NAME = 'currentSession';

    /**
     * @var Session
     */
    private $session;

    /**
     * @param Session $session
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /**
     * @return CurrentSession
     */
    public function getCurrentSession()
    {
        return $this->session->get(self::NAME);
    }

    public function start()
    {
        $newSession = new CurrentSession(new \DateTime());

        $this->session->set(self::NAME, $newSession);
    }

    public function clear()
    {
        $this->session->remove(self::NAME);
    }
}
