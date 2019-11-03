<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
/**
 * @ORM\Entity(repositoryClass="App\Repository\AnswerRepository")
 */
class Answer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="text", length=100)
     */
    private $answer;
    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Question", mappedBy="answers")
     */
    private $questions;
    
    public function __construct()
    {
        $this->questions = new ArrayCollection();
    }

    /**
     * @return Collection|Question[]
     */
    public function getQuestion(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions[] = $question;
            $question->addAnswer($this);
        }
        return $this;
    }
    public function removeQuestion(Question $question): self
    {
        if ($this->questions->contains($question)) {
            $this->questions->removeElement($question);
        }
        return $this;
    }
    
    //Getters & Setters answer
    public function getId(){
        return $this->id;
    }
    public function getAnswer(){
        return $this->answer;
    }
    public function setAnswer($answer){
        $this->answer = $answer;
    }

//    public function __toString(): string
//    {
//        return $this->getTitle();
//    }
}
