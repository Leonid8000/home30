<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PollRepository")
 */
class Poll
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="integer")
     */
    public $user_id;
    /**
     * @ORM\Column(type="text", length=100)
     */
    public $user_answer;

// User Id
    public function getUserId()
    {
        return $this->user_id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
        return $this;
    }

    //User Answer
    public function getUserAnswer()
    {
        return $this->user_answer;
    }
    public function setUserAnswer( $user_answer)
    {
        $this->user_answer = $user_answer;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
