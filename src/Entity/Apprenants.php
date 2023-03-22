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

    #[ORM\OneToOne(inversedBy: 'apprenants', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'apprenants')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Suivre $suivre = null;

    #[ORM\ManyToOne(inversedBy: 'apprenants')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Tutorat $tutorat = null;

    #[ORM\OneToMany(mappedBy: 'apprenants', targetEntity: Notes::class)]
    private Collection $notes;

    public function __construct()
    {
        $this->notes = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getSuivre(): ?Suivre
    {
        return $this->suivre;
    }

    public function setSuivre(?Suivre $suivre): self
    {
        $this->suivre = $suivre;

        return $this;
    }

    public function getTutorat(): ?Tutorat
    {
        return $this->tutorat;
    }

    public function setTutorat(?Tutorat $tutorat): self
    {
        $this->tutorat = $tutorat;

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

    
}
