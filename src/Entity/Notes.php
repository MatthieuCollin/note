<?php

namespace App\Entity;

use App\Repository\NotesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NotesRepository::class)]
class Notes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $note = null;

    #[ORM\ManyToOne(inversedBy: 'notes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?apprenants $apprenants = null;

    #[ORM\ManyToOne(inversedBy: 'notes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?matieres $matière = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getApprenants(): ?apprenants
    {
        return $this->apprenants;
    }

    public function setApprenants(?apprenants $apprenants): self
    {
        $this->apprenants = $apprenants;

        return $this;
    }

    public function getMatière(): ?matieres
    {
        return $this->matière;
    }

    public function setMatière(?matieres $matière): self
    {
        $this->matière = $matière;

        return $this;
    }
}
