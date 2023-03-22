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

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?int $idMatieres = null;

    #[ORM\OneToMany(mappedBy: 'formations', targetEntity: Suivre::class)]
    private Collection $suivres;

    #[ORM\ManyToMany(targetEntity: Matieres::class, inversedBy: 'formations')]
    private Collection $matieres;

    public function __construct()
    {
        $this->suivres = new ArrayCollection();
        $this->matieres = new ArrayCollection();
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

    public function getIdMatieres(): ?int
    {
        return $this->idMatieres;
    }

    public function setIdMatieres(int $idMatieres): self
    {
        $this->idMatieres = $idMatieres;

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
            $suivre->setFormations($this);
        }

        return $this;
    }

    public function removeSuivre(Suivre $suivre): self
    {
        if ($this->suivres->removeElement($suivre)) {
            // set the owning side to null (unless already changed)
            if ($suivre->getFormations() === $this) {
                $suivre->setFormations(null);
            }
        }

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
