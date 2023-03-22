<?php

namespace App\Entity;

use App\Repository\MatieresRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MatieresRepository::class)]
class Matieres
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $programme = null;

    #[ORM\ManyToMany(targetEntity: Formations::class, mappedBy: 'matieres')]
    private Collection $formations;

    #[ORM\ManyToMany(targetEntity: Enseigne::class, mappedBy: 'matieres')]
    private Collection $enseignes;

    #[ORM\ManyToMany(targetEntity: Notes::class, mappedBy: 'matieres')]
    private Collection $notes;

    public function __construct()
    {
        $this->formations = new ArrayCollection();
        $this->enseignes = new ArrayCollection();
        $this->notes = new ArrayCollection();
    }

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

    public function getProgramme(): ?string
    {
        return $this->programme;
    }

    public function setProgramme(string $programme): self
    {
        $this->programme = $programme;

        return $this;
    }

    /**
     * @return Collection<int, Formations>
     */
    public function getFormations(): Collection
    {
        return $this->formations;
    }

    public function addFormation(Formations $formation): self
    {
        if (!$this->formations->contains($formation)) {
            $this->formations->add($formation);
            $formation->addMatiere($this);
        }

        return $this;
    }

    public function removeFormation(Formations $formation): self
    {
        if ($this->formations->removeElement($formation)) {
            $formation->removeMatiere($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Enseigne>
     */
    public function getEnseignes(): Collection
    {
        return $this->enseignes;
    }

    public function addEnseigne(Enseigne $enseigne): self
    {
        if (!$this->enseignes->contains($enseigne)) {
            $this->enseignes->add($enseigne);
            $enseigne->addMatiere($this);
        }

        return $this;
    }

    public function removeEnseigne(Enseigne $enseigne): self
    {
        if ($this->enseignes->removeElement($enseigne)) {
            $enseigne->removeMatiere($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Notes>
     */
    public function getNotes(): Collection
    {
        return $this->notes;
    }

    public function addNote(Notes $note): self
    {
        if (!$this->notes->contains($note)) {
            $this->notes->add($note);
            $note->addMatiere($this);
        }

        return $this;
    }

    public function removeNote(Notes $note): self
    {
        if ($this->notes->removeElement($note)) {
            $note->removeMatiere($this);
        }

        return $this;
    }
}
