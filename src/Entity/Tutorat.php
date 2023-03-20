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

    #[ORM\Column]
    private ?int $idTuteur = null;

    #[ORM\Column]
    private ?int $idApprenants = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdTuteur(): ?int
    {
        return $this->idTuteur;
    }

    public function setIdTuteur(int $idTuteur): self
    {
        $this->idTuteur = $idTuteur;

        return $this;
    }

    public function getIdApprenants(): ?int
    {
        return $this->idApprenants;
    }

    public function setIdApprenants(int $idApprenants): self
    {
        $this->idApprenants = $idApprenants;

        return $this;
    }
}
