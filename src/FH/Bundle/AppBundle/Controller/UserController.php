<?php

namespace FH\Bundle\AppBundle\Controller;

use FH\Bundle\AppBundle\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use FH\Bundle\AppBundle\User\LoginUser;

/**
 * @author Bart van Amelsvoort <bart@freshheads.com>
 */
class UserController
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var LoginUser
     */
    private $loginUser;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * @param UserRepository $userRepository
     * @param LoginUser $loginUser
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(
        UserRepository $userRepository,
        LoginUser $loginUser,
        UrlGeneratorInterface $urlGenerator
    ) {
        $this->userRepository = $userRepository;
        $this->loginUser = $loginUser;
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @Template
     */
    public function loginAction(Request $request)
    {
        $code = $request->request->get('code');
        $user = $this->userRepository->findOneByCode($code);

        if ($user) {
            $this->loginUser->login($user);

            return new RedirectResponse(
                $this->urlGenerator->generate('user_pick')
            );
        }

        return [];
    }

    /**
     * @Template
     */
    public function pickAction()
    {
        return [];
    }
}
