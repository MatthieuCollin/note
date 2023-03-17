<?php

namespace App\Entity;

use App\Repository\EnseigneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EnseigneRepository::class)]
class Enseigne
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'enseignes')]
    private ?formateurs $formateur = null;

    #[ORM\OneToMany(mappedBy: 'enseigne', targetEntity: matieres::class)]
    private Collection $matiere;

    #[ORM\Column]
    private ?int $matiere_id = null;

    public function __construct()
    {
        $this->matiere = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFormateur(): ?formateurs
    {
        return $this->formateur;
    }

    public function setFormateur(?formateurs $formateur): self
    {
        $this->formateur = $formateur;

        return $this;
    }

    /**
     * @return Collection<int, matieres>
     */
    public function getMatiere(): Collection
    {
        return $this->matiere;
    }

    public function addMatiere(matieres $matiere): self
    {
        if (!$this->matiere->contains($matiere)) {
            $this->matiere->add($matiere);
            $matiere->setEnseigne($this);
        }

        return $this;
    }

    public function removeMatiere(matieres $matiere): self
    {
        if ($this->matiere->removeElement($matiere)) {
            // set the owning side to null (unless already changed)
            if ($matiere->getEnseigne() === $this) {
                $matiere->setEnseigne(null);
            }
        }

        return $this;
    }

    public function getMatiereId(): ?int
    {
        return $this->matiere_id;
    }

    public function setMatiereId(int $matiere_id): self
    {
        $this->matiere_id = $matiere_id;

        return $this;
    }
}
