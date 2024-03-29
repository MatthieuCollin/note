<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)] 
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\OneToMany(mappedBy: 'formateur', targetEntity: Controle::class)]
    private Collection $controle;

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?Classe $classe = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?Matiere $matiere = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'eleve')]
    private ?self $user = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: self::class)]
    private Collection $eleve;

    public function __construct()
    {
        $this->controle = new ArrayCollection();
        $this->eleve = new ArrayCollection();
    }

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
    public function getUserIdentifier(): string
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
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * @return Collection<int, Controle>
     */
    public function getControle(): Collection
    {
        return $this->controle;
    }

    public function addControle(Controle $classe): self
    {
        if (!$this->controle->contains($classe)) {
            $this->controle->add($classe);
            $classe->setFormateur($this);
        }

        return $this;
    }

    public function removeControle(Controle $controle): self
    {
        if ($this->controle->removeElement($controle)) {
            // set the owning side to null (unless already changed)
            if ($controle->getFormateur() === $this) {
                $controle->setFormateur(null);
            }
        }

        return $this;
    }

    public function getClasse(): ?Classe
    {
        return $this->classe;
    }

    public function setClasse(?Classe $classe): self
    {
        $this->classe = $classe;

        return $this;
    }

    public function getMatiere(): ?Matiere
    {
        return $this->matiere;
    }

    public function setMatiere(?Matiere $matiere): self
    {
        $this->matiere = $matiere;

        return $this;
    }

    public function getUser(): ?self
    {
        return $this->user;
    }

    public function setUser(?self $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getEleve(): Collection
    {
        return $this->eleve;
    }

    public function addEleve(self $eleve): self
    {
        if (!$this->eleve->contains($eleve)) {
            $this->eleve->add($eleve);
            $eleve->setUser($this);
        }

        return $this;
    }

    public function removeEleve(self $eleve): self
    {
        if ($this->eleve->removeElement($eleve)) {
            // set the owning side to null (unless already changed)
            if ($eleve->getUser() === $this) {
                $eleve->setUser(null);
            }
        }

        return $this;
    }
}
