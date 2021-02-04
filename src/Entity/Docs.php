<?php

namespace App\Entity;

use App\Repository\DocsRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo; // gedmo annotations
use Gedmo\Timestampable\Traits\TimestampableEntity;
/**
 * @ORM\Entity(repositoryClass=DocsRepository::class)
 */
class Docs
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=110)
     */
    private $doctit;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $docref;

    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDoctit(): ?string
    {
        return $this->doctit;
    }

    public function setDoctit(string $doctit): self
    {
        $this->doctit = $doctit;

        return $this;
    }

    public function getDocref(): ?string
    {
        return $this->docref;
    }

    public function setDocref(string $docref): self
    {
        $this->docref = $docref;

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
