<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AnsRepository")
 */
class Ans
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
    private $ans;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Que", inversedBy="ans")
     * @ORM\JoinColumn(nullable=false)
     */
    private $que;

    /**
     * @ORM\Column(type="integer")
     */
    private $poll_count;

    public function getId(): int
    {
        return $this->id;
    }

    public function getAns(): string
    {
        return $this->ans;
    }

    public function setAns(string $ans): self
    {
        $this->ans = $ans;

        return $this;
    }

    public function getQue(): Que
    {
        return $this->que;
    }

    public function setQue(Que $que): self
    {
        $this->que = $que;

        return $this;
    }

    public function getPollCount(): int
    {
        return $this->poll_count;
    }

    public function setPollCount(int $poll_count): self
    {
        $this->poll_count = $poll_count;

        return $this;
    }
}
