<?php

namespace FH\Bundle\AppBundle\Controller;

use FH\Bundle\AppBundle\Repository\QuestionRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

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
     * @param QuestionRepository $questionRepository
     */
    public function __construct(QuestionRepository $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }

    /**
     * @Template
     */
    public function indexAction()
    {
        $question = $this->questionRepository->findOneRandom();

        return [
            'question' => $question
        ];
    }
}
