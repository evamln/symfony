<?php

namespace App\Entity;

use App\Repository\PosesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PosesRepository::class)]
class Poses
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'pose')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Personnages $personnages = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPersonnages(): ?Personnages
    {
        return $this->personnages;
    }

    public function setPersonnages(?Personnages $personnages): static
    {
        $this->personnages = $personnages;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }
}
