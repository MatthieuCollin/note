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
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column]
    private ?int $idApprenants = null;

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
