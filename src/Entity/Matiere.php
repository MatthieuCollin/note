<?php

namespace App\Entity;

use App\Repository\MatiereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MatiereRepository::class)]
class Matiere
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'matiere', targetEntity: Controle::class)]
    private Collection $controles;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'matieres')]
    private Collection $formateur;

    #[ORM\OneToMany(mappedBy: 'matiere', targetEntity: Programme::class)]
    private Collection $programmes;

    public function __construct()
    {
        $this->controles = new ArrayCollection();
        $this->formateur = new ArrayCollection();
        $this->programmes = new ArrayCollection();
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
    public function getControles(): Collection
    {
        return $this->controles;
    }

    public function addControle(Controle $controle): self
    {
        if (!$this->controles->contains($controle)) {
            $this->controles->add($controle);
            $controle->setMatiere($this);
        }

        return $this;
    }

    public function removeControle(Controle $controle): self
    {
        if ($this->controles->removeElement($controle)) {
            // set the owning side to null (unless already changed)
            if ($controle->getMatiere() === $this) {
                $controle->setMatiere(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getFormateur(): Collection
    {
        return $this->formateur;
    }

    public function addFormateur(User $formateur): self
    {
        if (!$this->formateur->contains($formateur)) {
            $this->formateur->add($formateur);
        }

        return $this;
    }

    public function removeFormateur(User $formateur): self
    {
        $this->formateur->removeElement($formateur);

        return $this;
    }

    /**
     * @return Collection<int, Programme>
     */
    public function getProgrammes(): Collection
    {
        return $this->programmes;
    }

    public function addProgramme(Programme $programme): self
    {
        if (!$this->programmes->contains($programme)) {
            $this->programmes->add($programme);
            $programme->setMatiere($this);
        }

        return $this;
    }

    public function removeProgramme(Programme $programme): self
    {
        if ($this->programmes->removeElement($programme)) {
            // set the owning side to null (unless already changed)
            if ($programme->getMatiere() === $this) {
                $programme->setMatiere(null);
            }
        }

        return $this;
    }
}
