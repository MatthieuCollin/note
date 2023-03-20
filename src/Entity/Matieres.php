<?php

namespace App\Entity;

use App\Repository\MatieresRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MatieresRepository::class)]
class Matieres
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $idMatieres = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $programme = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdMatieres(): ?string
    {
        return $this->idMatieres;
    }

    public function setIdMatieres(string $idMatieres): self
    {
        $this->idMatieres = $idMatieres;

        return $this;
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

    public function getProgramme(): ?string
    {
        return $this->programme;
    }

    public function setProgramme(string $programme): self
    {
        $this->programme = $programme;

        return $this;
    }
}
