<?php

namespace App\Entity;

use App\Repository\FormationsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormationsRepository::class)]
class Formations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $idFormations = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $idMatieres = null;

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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
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
}
