<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
/**
 * @ORM\Entity(repositoryClass="App\Repository\QuestionRepository")
 */
class Question
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
    public $title;
    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Answer", inversedBy="questions")
     */
    public $answers;

    public function __construct()
    {
        $this->answers = new ArrayCollection();
    }

    /**
     * @return Collection|Question[]
     */
    public function getAnswers(): Collection
    {
        return $this->answers;
    }

    public function addAnswer(Answer $answer): self
    {
        if (!$this->answers->contains($answer)) {
            $this->answers[] = $answer;
            $answer->addQuestion($this);
        }
        return $this;
    }
    public function removeAnswer(Answer $answer): self
    {
        if ($this->answers->contains($answer)) {
            $this->answers->removeElement($answer);
        }
        return $this;
    }

    //Getters & Setters questions
    public function getId(){
        return $this->id;
    }
//    Title 1
    public function getTitle(){
        return $this->title;
    }
    public function setTitle($title){
        $this->title = $title;
    }

}
