<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $role = null;

    #[ORM\OneToOne(mappedBy: 'user', cascade: ['persist', 'remove'])]
    private ?Apprenants $apprenants = null;

    #[ORM\OneToOne(mappedBy: 'user', cascade: ['persist', 'remove'])]
    private ?Formateurs $formateurs = null;

    #[ORM\OneToOne(mappedBy: 'user', cascade: ['persist', 'remove'])]
    private ?Tuteurs $tuteurs = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getApprenants(): ?Apprenants
    {
        return $this->apprenants;
    }

    public function setApprenants(Apprenants $apprenants): self
    {
        // set the owning side of the relation if necessary
        if ($apprenants->getUser() !== $this) {
            $apprenants->setUser($this);
        }

        $this->apprenants = $apprenants;

        return $this;
    }

    public function getFormateurs(): ?Formateurs
    {
        return $this->formateurs;
    }

    public function setFormateurs(Formateurs $formateurs): self
    {
        // set the owning side of the relation if necessary
        if ($formateurs->getUser() !== $this) {
            $formateurs->setUser($this);
        }

        $this->formateurs = $formateurs;

        return $this;
    }

    public function getTuteurs(): ?Tuteurs
    {
        return $this->tuteurs;
    }

    public function setTuteurs(Tuteurs $tuteurs): self
    {
        // set the owning side of the relation if necessary
        if ($tuteurs->getUser() !== $this) {
            $tuteurs->setUser($this);
        }

        $this->tuteurs = $tuteurs;

        return $this;
    }
}
