<?php

namespace FH\Bundle\AppBundle\Controller;

use Doctrine\ORM\EntityManager;
use FH\Bundle\AppBundle\Entity\Consumption;
use FH\Bundle\AppBundle\Entity\User;
use FH\Bundle\AppBundle\Repository\QuestionRepository;
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
     * @var QuestionRepository
     */
    private $questionRepository;

    /**
     * @var LoginUser
     */
    private $loginUser;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @param UserRepository $userRepository
     * @param QuestionRepository $questionRepository
     * @param LoginUser $loginUser
     * @param UrlGeneratorInterface $urlGenerator
     * @param EntityManager $entityManager
     */
    public function __construct(
        UserRepository $userRepository,
        QuestionRepository $questionRepository,
        LoginUser $loginUser,
        UrlGeneratorInterface $urlGenerator,
        EntityManager $entityManager
    ) {
        $this->userRepository = $userRepository;
        $this->questionRepository = $questionRepository;
        $this->loginUser = $loginUser;
        $this->urlGenerator = $urlGenerator;
        $this->entityManager = $entityManager;
    }

    /**
     * @Template
     *
     * @param Request $request
     * @return array
     */
    public function loginAction(Request $request)
    {
        $code = $request->request->get('code');
        $user = $this->userRepository->findOneByCode($code);

        if ($user) {
            $this->loginUser->login($user);

            return new RedirectResponse(
                $this->urlGenerator->generate('user_consumption')
            );
        }

        return [];
    }

    /**
     * @Template
     *
     * @param Request $request
     * @return array
     */
    public function consumptionAction(Request $request)
    {
        /** @var User $currentUser */
        $currentUser = $this->entityManager->merge($this->loginUser->getUser());
        $users = $this->userRepository->findAllExceptUser($currentUser);

        $receiverId = $request->query->get('receiver_id');
        $receiver = $this->userRepository->findOneById($receiverId);

        if ($receiver) {
            $consumption = new Consumption($currentUser, $receiver);

            $this->entityManager->persist($consumption);
            $this->entityManager->flush();

            return new RedirectResponse(
                $this->urlGenerator->generate('question_detail', [
                    'id' => $this->questionRepository->findOneRandom()->getId()
                ])
            );
        }

        return [
            'users' => $users
        ];
    }
}
