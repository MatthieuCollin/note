<?php

namespace App\Entity;

use App\Repository\TuteursRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TuteursRepository::class)]
class Tuteurs
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $idTuteurs = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

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
