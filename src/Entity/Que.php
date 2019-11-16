<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="App\Repository\QueRepository")
 */
class Que
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
    private $que;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ans", mappedBy="que")
     */
    private $ans;

    public function __construct()
    {
        $this->ans = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getQue(): string
    {
        return $this->que;
    }

    public function setQue(string $que): self
    {
        $this->que = $que;

        return $this;
    }

    /**
     * @return Collection|Ans[]
     */
    public function getAns(): Collection
    {
        return $this->ans;
    }

    public function addAn(Ans $an): self
    {
        if (!$this->ans->contains($an)) {
            $this->ans[] = $an;
            $an->setQue($this);
        }

        return $this;
    }

    public function removeAn(Ans $an): self
    {
        if ($this->ans->contains($an)) {
            $this->ans->removeElement($an);
            // set the owning side to null (unless already changed)
            if ($an->getQue() === $this) {
                $an->setQue(null);
            }
        }

        return $this;
    }
}
