<?php

namespace App\Entity;

use App\Repository\ClasseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClasseRepository::class)]
class Classe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'classe', targetEntity: Controle::class)]
    private Collection $controle;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'classes')]
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Controle>
     */
    public function getcontrole(): Collection
    {
        return $this->controle;
    }

    public function addcontrole(Controle $controle): self
    {
        if (!$this->controle->contains($controle)) {
            $this->controle->add($controle);
            $controle->setClasse($this);
        }

        return $this;
    }

    public function removecontrole(Controle $controle): self
    {
        if ($this->controle->removeElement($controle)) {
            // set the owning side to null (unless already changed)
            if ($controle->getFormateur() === $this) {
                $controle->setFormateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getEleve(): Collection
    {
        return $this->eleve;
    }

    public function addEleve(User $eleve): self
    {
        if (!$this->eleve->contains($eleve)) {
            $this->eleve->add($eleve);
        }

        return $this;
    }

    public function removeEleve(User $eleve): self
    {
        $this->eleve->removeElement($eleve);

        return $this;
    }

}
