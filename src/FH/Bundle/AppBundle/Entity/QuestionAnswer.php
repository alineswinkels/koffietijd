<?php

namespace FH\Bundle\AppBundle\Entity;

/**
 * @author Bart van Amelsvoort <bart@freshheads.com>
 */
class QuestionAnswer
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var boolean
     */
    private $correct;

    /**
     * @var Question
     */
    private $question;

    /**
     * @var User
     */
    private $user;

    /**
     * @param User $user
     * @param Question $question
     * @param bool $correct
     */
    public function __construct(User $user, Question $question, $correct)
    {
        $this->user = $user;
        $this->question = $question;
        $this->correct = $correct;
        $this->createdAt = new \DateTime();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return boolean
     */
    public function isCorrect()
    {
        return $this->correct;
    }

    /**
     * @return Question
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }
}
