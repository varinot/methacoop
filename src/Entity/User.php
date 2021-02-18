<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\Traits\Gestemps;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity(fields={"email"}, message="Il y a déjà un compte avec cet email")
 */
class User implements UserInterface
{
    use Gestemps;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     * @Assert\NotBlank(message="le nom doit avoir au moins 1 caractère alphabétique")
     * @Assert\Length(min=1)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=12)
     */
    private $numvoie;

    /**
     * @ORM\Column(type="string", length=18, nullable=true)
     */
    private $typvoie;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $voienom;

    /**
     * @ORM\Column(type="string", length=6, nullable=true)
     * @Assert\NotBlank(message="le code postal doit avoir au moins 4 caractères")
     * @Assert\Length(min=4)
     */
    private $codpost;

    /**
     * @ORM\Column(type="string", length=80, nullable=true)
     * @Assert\NotBlank(message="le nom de ville doit avoir au moins 2 caractères")
     * @Assert\Length(min=2)
     */
    private $ville;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbdepot;

    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVerified = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNumvoie(): ?string
    {
        return $this->numvoie;
    }

    public function setNumvoie(string $numvoie): self
    {
        $this->numvoie = $numvoie;

        return $this;
    }

    public function getTypvoie(): ?string
    {
        return $this->typvoie;
    }

    public function setTypvoie(?string $typvoie): self
    {
        $this->typvoie = $typvoie;

        return $this;
    }

    public function getVoienom(): ?string
    {
        return $this->voienom;
    }

    public function setVoienom(?string $voienom): self
    {
        $this->voienom = $voienom;

        return $this;
    }

    public function getCodpost(): ?string
    {
        return $this->codpost;
    }

    public function setCodpost(?string $codpost): self
    {
        $this->codpost = $codpost;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getNbdepot(): ?int
    {
        return $this->nbdepot;
    }

    public function setNbdepot(?int $nbdepot): self
    {
        $this->nbdepot = $nbdepot;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }
}
