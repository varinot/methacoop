<?php

namespace App\Entity\Traits;

trait Gescredat
{
     /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    private $createdAt;
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */ 
    
    public function Majcre()
    {
        if ($this->getCreatedAt() === null){
        $this->setCreatedAt(new \DateTimeImmutable());
        }
    }    
}   