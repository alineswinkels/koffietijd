<?php

namespace FH\Bundle\AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Main controller.
 *
 * @author Joost Farla <joost.farla@freshheads.com>
 */
class MainController extends Controller
{
    /**
     * @Template
     */
    public function homeAction()
    {
        return array();
    }
}
