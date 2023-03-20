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

    #[ORM\Column]
    private ?int $idFormateurs = null;

    #[ORM\Column]
    private ?int $idApprenants = null;

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
