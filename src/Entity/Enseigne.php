<?php

namespace App\Entity;

use App\Repository\EnseigneRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EnseigneRepository::class)]
class Enseigne
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $idFormateurs = null;

    #[ORM\Column(length: 255)]
    private ?string $idMatieres = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdFormateurs(): ?string
    {
        return $this->idFormateurs;
    }

    public function setIdFormateurs(string $idFormateurs): self
    {
        $this->idFormateurs = $idFormateurs;

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
