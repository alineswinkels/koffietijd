<?php

namespace FH\Bundle\AppBundle\Controller;

use Doctrine\ORM\EntityManager;
use FH\Bundle\AppBundle\Entity\Question;
use FH\Bundle\AppBundle\Entity\QuestionAnswer;
use FH\Bundle\AppBundle\Entity\User;
use FH\Bundle\AppBundle\User\LoginUser;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use FH\Bundle\AppBundle\Repository\QuestionRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * @author Bart van Amelsvoort <bart@freshheads.com>
 */
class QuestionController
{
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
     * @param QuestionRepository $questionRepository
     * @param LoginUser $loginUser
     * @param UrlGeneratorInterface $urlGenerator
     * @param EntityManager $entityManager
     */
    public function __construct(
        QuestionRepository $questionRepository,
        LoginUser $loginUser,
        UrlGeneratorInterface $urlGenerator,
        EntityManager $entityManager
    ) {
        $this->questionRepository = $questionRepository;
        $this->loginUser = $loginUser;
        $this->urlGenerator = $urlGenerator;
        $this->entityManager = $entityManager;
    }

    /**
     * @Template
     *
     * @param Request $request
     * @param Question $question
     * @return array
     */
    public function detailAction(Request $request, Question $question)
    {
        /** @var User $currentUser */
        $currentUser = $this->entityManager->merge($this->loginUser->getUser());

        $answer = $request->request->get('answer');

        if ($answer) {
            $correct = $answer == $question->getCorrectAnswer();
            $consumption = new QuestionAnswer($currentUser, $question, $correct);

            $this->entityManager->persist($consumption);
            $this->entityManager->flush();

            return new RedirectResponse(
                $this->urlGenerator->generate('home')
            );
        }

        return [
            'question' => $question
        ];
    }
}
