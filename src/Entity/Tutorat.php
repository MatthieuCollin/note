<?php

namespace App\Entity;

use App\Repository\TutoratRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TutoratRepository::class)]
class Tutorat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $idTuteurs = null;

    #[ORM\Column(length: 255)]
    private ?string $idApprenants = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdTuteurs(): ?string
    {
        return $this->idTuteurs;
    }

    public function setIdTuteurs(string $idTuteurs): self
    {
        $this->idTuteurs = $idTuteurs;

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
