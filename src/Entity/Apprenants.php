<?php

namespace App\Entity;

use App\Repository\ApprenantsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApprenantsRepository::class)]
class Apprenants
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $idApprenants = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    public function getId(): ?int
    {
        return $this->id;
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
}
