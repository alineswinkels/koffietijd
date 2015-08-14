<?php

namespace FH\Bundle\AppBundle\Controller;

use FH\Bundle\AppBundle\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @author Bart van Amelsvoort <bart@freshheads.com>
 */
class MainController
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @Template
     *
     * @return array
     */
    public function homeAction()
    {
        $topFetchers = $this->userRepository->getTopFetchers();
        $topReceivers = $this->userRepository->getTopReceivers();
        $topQuestionResults = $this->userRepository->getTopQuestionResults();

        return [
            'topFetchers' => $topFetchers,
            'topReceivers' => $topReceivers,
            'topQuestionResults' => $topQuestionResults

        ];
    }
}
