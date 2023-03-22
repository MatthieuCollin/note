<?php

namespace App\Entity;

use App\Repository\TutoratRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TutoratRepository::class)]
class Tutorat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'tutorats')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Tuteurs $tuteurs = null;

    #[ORM\OneToMany(mappedBy: 'tutorat', targetEntity: Apprenants::class, orphanRemoval: true)]
    private Collection $apprenants;

    public function __construct()
    {
        $this->apprenants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTuteurs(): ?Tuteurs
    {
        return $this->tuteurs;
    }

    public function setTuteurs(?Tuteurs $tuteurs): self
    {
        $this->tuteurs = $tuteurs;

        return $this;
    }

    /**
     * @return Collection<int, Apprenants>
     */
    public function getApprenants(): Collection
    {
        return $this->apprenants;
    }

    public function addApprenant(Apprenants $apprenant): self
    {
        if (!$this->apprenants->contains($apprenant)) {
            $this->apprenants->add($apprenant);
            $apprenant->setTutorat($this);
        }

        return $this;
    }

    public function removeApprenant(Apprenants $apprenant): self
    {
        if ($this->apprenants->removeElement($apprenant)) {
            // set the owning side to null (unless already changed)
            if ($apprenant->getTutorat() === $this) {
                $apprenant->setTutorat(null);
            }
        }

        return $this;
    }
}
