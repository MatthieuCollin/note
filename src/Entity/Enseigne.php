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

    #[ORM\Column]
    private ?int $idFormateurs = null;

    #[ORM\Column]
    private ?int $idMatieres = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdFormateurs(): ?int
    {
        return $this->idFormateurs;
    }

    public function setIdFormateurs(int $idFormateurs): self
    {
        $this->idFormateurs = $idFormateurs;

        return $this;
    }

    public function getIdMatieres(): ?int
    {
        return $this->idMatieres;
    }

    public function setIdMatieres(int $idMatieres): self
    {
        $this->idMatieres = $idMatieres;

        return $this;
    }
}
