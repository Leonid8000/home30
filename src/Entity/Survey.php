<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SurveyRepository")
 */
class Survey
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
    private $name;

    /**
     * @ORM\Column(type="smallint")
     */
    private $questionsPerPage;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SurveyQuestion", mappedBy="survey", orphanRemoval=true)
     */
    private $questions;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getQuestionsPerPage(): int
    {
        return $this->questionsPerPage;
    }

    public function setQuestionsPerPage(int $QuestionsPerPage): self
    {
        $this->questionsPerPage = $QuestionsPerPage;

        return $this;
    }

    /**
     * @return Collection|SurveyQuestion[]
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(SurveyQuestion $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions[] = $question;
            $question->setSurvey($this);
        }

        return $this;
    }

    public function removeQuestion(SurveyQuestion $question): self
    {
        if ($this->questions->contains($question)) {
            $this->questions->removeElement($question);
            // set the owning side to null (unless already changed)
            if ($question->getSurvey() === $this) {
                $question->setSurvey(null);
            }
        }
        return $this;
    }
}
