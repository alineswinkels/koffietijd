<?php

namespace FH\Bundle\AppBundle\Controller;

use FH\Bundle\AppBundle\Repository\UserRepository;
use FH\Bundle\AppBundle\Session\SessionProvider;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

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
     * @var SessionProvider
     */
    private $sessionProvider;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * @param UserRepository $userRepository
     * @param SessionProvider $sessionProvider
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(
        UserRepository $userRepository,
        SessionProvider $sessionProvider,
        UrlGeneratorInterface $urlGenerator
    ) {
        $this->userRepository = $userRepository;
        $this->sessionProvider = $sessionProvider;
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @Template
     *
     * @return array
     */
    public function homeAction()
    {
        $this->sessionProvider->clear();

        $topFetchers = $this->userRepository->getTopFetchers();
        $topReceivers = $this->userRepository->getTopReceivers();
        $topQuestionResults = $this->userRepository->getTopQuestionResults();

        return [
            'topFetchers' => $topFetchers,
            'topReceivers' => $topReceivers,
            'topQuestionResults' => $topQuestionResults
        ];
    }

    /**
     * @return RedirectResponse
     */
    public function startSessionAction()
    {
        $this->sessionProvider->start();

        return new RedirectResponse(
            $this->urlGenerator->generate('user_login')
        );
    }
}
