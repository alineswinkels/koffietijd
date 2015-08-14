<?php

namespace FH\Bundle\AppBundle\Controller;

use Doctrine\ORM\EntityManager;
use FH\Bundle\AppBundle\User\LoginUser;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use FH\Bundle\AppBundle\Repository\QuestionRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * @author Bart van Amelsvoort <bart@freshheads.com>
 */
class MainController
{
    /**
     * @Template
     *
     * @param Request $request
     * @return array
     */
    public function homeAction(Request $request)
    {
        return [];
    }
}
