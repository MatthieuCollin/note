<?php

namespace App\Entity;

use App\Repository\NoteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NoteRepository::class)]
class Note
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $note = null;

    #[ORM\Column(length: 255)]
    private ?string $idApprenants = null;

    #[ORM\Column(length: 255)]
    private ?string $idMatieres = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(string $note): self
    {
        $this->note = $note;

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
