<?php

namespace App\Entity;

use App\Repository\SuivreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SuivreRepository::class)]
class Suivre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: formations::class, inversedBy: 'suivres')]
    private Collection $formation;

    #[ORM\ManyToMany(targetEntity: apprenants::class, inversedBy: 'suivres')]
    private Collection $apprenant;

    public function __construct()
    {
        $this->formation = new ArrayCollection();
        $this->apprenant = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, formations>
     */
    public function getFormation(): Collection
    {
        return $this->formation;
    }

    public function addFormation(formations $formation): self
    {
        if (!$this->formation->contains($formation)) {
            $this->formation->add($formation);
        }

        return $this;
    }

    public function removeFormation(formations $formation): self
    {
        $this->formation->removeElement($formation);

        return $this;
    }

    /**
     * @return Collection<int, apprenants>
     */
    public function getApprenant(): Collection
    {
        return $this->apprenant;
    }

    public function addApprenant(apprenants $apprenant): self
    {
        if (!$this->apprenant->contains($apprenant)) {
            $this->apprenant->add($apprenant);
        }

        return $this;
    }

    public function removeApprenant(apprenants $apprenant): self
    {
        $this->apprenant->removeElement($apprenant);

        return $this;
    }
}
