<?php

namespace App\Entity;

use App\Repository\FormationsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormationsRepository::class)]
class Formations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: matieres::class, inversedBy: 'formations')]
    private Collection $nom;

    #[ORM\ManyToMany(targetEntity: Suivre::class, mappedBy: 'formation')]
    private Collection $suivres;

    public function __construct()
    {
        $this->nom = new ArrayCollection();
        $this->suivres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, matieres>
     */
    public function getNom(): Collection
    {
        return $this->nom;
    }

    public function addNom(matieres $nom): self
    {
        if (!$this->nom->contains($nom)) {
            $this->nom->add($nom);
        }

        return $this;
    }

    public function removeNom(matieres $nom): self
    {
        $this->nom->removeElement($nom);

        return $this;
    }

    /**
     * @return Collection<int, Suivre>
     */
    public function getSuivres(): Collection
    {
        return $this->suivres;
    }

    public function addSuivre(Suivre $suivre): self
    {
        if (!$this->suivres->contains($suivre)) {
            $this->suivres->add($suivre);
            $suivre->addFormation($this);
        }

        return $this;
    }

    public function removeSuivre(Suivre $suivre): self
    {
        if ($this->suivres->removeElement($suivre)) {
            $suivre->removeFormation($this);
        }

        return $this;
    }
}
