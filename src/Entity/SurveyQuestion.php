<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SurveyQuestionsRepository")
 * @ORM\Table(name="survey_questions")
 */
class SurveyQuestion
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $question;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Survey", inversedBy="questions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $survey;

    public function getId(): int
    {
        return $this->id;
    }

    public function getQuestion(): string
    {
        return $this->question;
    }

    public function setQuestion(string $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function getSurvey(): Survey
    {
        return $this->survey;
    }

    public function setSurvey(Survey $survey): self
    {
        $this->survey = $survey;

        return $this;
    }
}
