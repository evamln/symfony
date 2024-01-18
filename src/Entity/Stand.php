<?php

namespace App\Entity;

use App\Repository\StandRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StandRepository::class)]
class Stand
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;


    #[ORM\Column(type: Types::ARRAY)]
    private array $pouvoirs = [];

    #[ORM\Column(type: Types::ARRAY)]
    private array $pointsFort = [];

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPouvoirs(): array
    {
        return $this->pouvoirs;
    }

    public function setPouvoirs(array $pouvoirs): static
    {
        $this->pouvoirs = $pouvoirs;

        return $this;
    }

    public function getPointsFort(): array
    {
        return $this->pointsFort;
    }

    public function setPointsFort(array $pointsFort): static
    {
        $this->pointsFort = $pointsFort;

        return $this;
    }
}
