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

    #[ORM\ManyToMany(targetEntity: Formateurs::class, inversedBy: 'enseignes')]
    private Collection $formateurs;

    #[ORM\ManyToMany(targetEntity: Matieres::class, inversedBy: 'enseignes')]
    private Collection $matieres;

    public function __construct()
    {
        $this->formateurs = new ArrayCollection();
        $this->matieres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Formateurs>
     */
    public function getFormateurs(): Collection
    {
        return $this->formateurs;
    }

    public function addFormateur(Formateurs $formateur): self
    {
        if (!$this->formateurs->contains($formateur)) {
            $this->formateurs->add($formateur);
        }

        return $this;
    }

    public function removeFormateur(Formateurs $formateur): self
    {
        $this->formateurs->removeElement($formateur);

        return $this;
    }

    /**
     * @return Collection<int, Matieres>
     */
    public function getMatieres(): Collection
    {
        return $this->matieres;
    }

    public function addMatiere(Matieres $matiere): self
    {
        if (!$this->matieres->contains($matiere)) {
            $this->matieres->add($matiere);
        }

        return $this;
    }

    public function removeMatiere(Matieres $matiere): self
    {
        $this->matieres->removeElement($matiere);

        return $this;
    }
}
