<?php

namespace App\Entity;

use App\Repository\SuivreRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SuivreRepository::class)]
class Suivre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $idFormations = null;

    #[ORM\Column(length: 255)]
    private ?string $idApprenants = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdFormations(): ?string
    {
        return $this->idFormations;
    }

    public function setIdFormations(string $idFormations): self
    {
        $this->idFormations = $idFormations;

        return $this;
    }

    public function getIdApprenants(): ?string
    {
        return $this->idApprenants;
    }

    public function setIdApprenants(string $idApprenants): self
    {
        $this->idApprenants = $idApprenants;

        return $this;
    }
}
