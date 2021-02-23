<?php

namespace App\Entity;

use App\Repository\DepotsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use App\Entity\Traits\Gestemps;
/**
 * @ORM\Entity(repositoryClass=DepotsRepository::class)
 * @Vich\Uploadable
 * @ORM\HasLifecycleCallbacks
 */
class Depots
{
    use Gestemps;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=80)
     * @Assert\NotBlank(message="le titre doit avoir au moins 4 caractères")
     * @Assert\Length(min=4)
     */
    private $depotit;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="docs_image", fileNameProperty="imageName")
     * 
     * @var File|null
     */
    private $imageFile;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $depoavis;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $deporef;

    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $imageName;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $depocorres;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="depots")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDepotit(): ?string
    {
        return $this->depotit;
    }

    public function setDepotit(string $depotit): self
    {
        $this->depotit = $depotit;

        return $this;
    }

    public function getDepoavis(): ?string
    {
        return $this->depoavis;
    }

    public function setDepoavis(?string $depoavis): self
    {
        $this->depoavis = $depoavis;

        return $this;
    }

     /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->setUpdatedAt(new \DateTimeImmutable);
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function getDeporef(): ?string
    {
        return $this->deporef;
    }

    public function setDeporef(?string $deporef): self
    {
        $this->deporef = $deporef;

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

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(?string $imageName): self
    {
        $this->imageName = $imageName;

        return $this;
    }

    public function getDepocorres(): ?string
    {
        return $this->depocorres;
    }

    public function setDepocorres(?string $depocorres): self
    {
        $this->depocorres = $depocorres;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */ 
    
    public function updateTimestamp()
    {
       if($this->getCreatedAt()=== null)
       {
          $this->setCreatedAt(new \DateTimeImmutable());
       }
       $this->setUpdatedAt(new \DateTimeImmutable());
    }
}
