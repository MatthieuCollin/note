<?php

namespace App\Entity;

use App\Repository\ApprenantsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApprenantsRepository::class)]
class Apprenants
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\OneToMany(mappedBy: 'apprenants', targetEntity: Notes::class)]
    private Collection $notes;

    #[ORM\ManyToMany(targetEntity: Suivre::class, mappedBy: 'apprenant')]
    private Collection $suivres;

    public function __construct()
    {
        $this->notes = new ArrayCollection();
        $this->suivres = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

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
            $note->setApprenants($this);
        }

        return $this;
    }

    public function removeNote(Notes $note): self
    {
        if ($this->notes->removeElement($note)) {
            // set the owning side to null (unless already changed)
            if ($note->getApprenants() === $this) {
                $note->setApprenants(null);
            }
        }

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
            $suivre->addApprenant($this);
        }

        return $this;
    }

    public function removeSuivre(Suivre $suivre): self
    {
        if ($this->suivres->removeElement($suivre)) {
            $suivre->removeApprenant($this);
        }

        return $this;
    }
}
