<?php

namespace App\Entity;

use App\Entity\Traits\Gestemps;
use App\Repository\NewsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass=NewsRepository::class)
 * @ORM\HasLifecycleCallbacks
 */
class News
{
    use Gestemps;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message="le titre doit avoir au moins 4 caractères")
     * @Assert\Length(min=4)
     */
    private $newstit;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\NotBlank(message="le contenu doit avoir au moins 14 caractères")
     * @Assert\Length(min=14)
     */
    private $newscont;

    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    private $createdAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNewstit(): ?string
    {
        return $this->newstit;
    }

    public function setNewstit(?string $newstit): self
    {
        $this->newstit = $newstit;

        return $this;
    }

    public function getNewscont(): ?string
    {
        return $this->newscont;
    }

    public function setNewscont(?string $newscont): self
    {
        $this->newscont = $newscont;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

   

}
