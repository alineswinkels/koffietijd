<?php

namespace FH\Bundle\AppBundle\Entity;

/**
 * @author Bart van Amelsvoort <bart@freshheads.com>
 */
class Question
{
    const TYPE_MOVIE_IMAGE = 'movie_image';

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $image;

    /**
     * @var string
     */
    private $answerA;

    /**
     * @var string
     */
    private $answerB;

    /**
     * @var string
     */
    private $answerC;

    /**
     * @var string
     */
    private $answerD;

    /**
     * @var string
     */
    private $correctAnswer;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return string
     */
    public function getAnswerA()
    {
        return $this->answerA;
    }

    /**
     * @return string
     */
    public function getAnswerB()
    {
        return $this->answerB;
    }

    /**
     * @return string
     */
    public function getAnswerC()
    {
        return $this->answerC;
    }

    /**
     * @return string
     */
    public function getAnswerD()
    {
        return $this->answerD;
    }

    /**
     * @return string
     */
    public function getCorrectAnswer()
    {
        return $this->correctAnswer;
    }

    public function getTitle()
    {
        switch ($this->type) {
            case self::TYPE_MOVIE_IMAGE:
                return 'Welke film is dit?';
        }
    }

    public function getImagePath()
    {
        return sprintf('uploads/question/%s', $this->image);
    }
}
