<?php

namespace App\Entity;

use App\Repository\StandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\ManyToMany(targetEntity: Pouvoirs::class)]
    private Collection $Pouvoirs;

    #[ORM\ManyToMany(targetEntity: PointsFort::class)]
    private Collection $PointsFort;


    public function __construct()
    {
        $this->Pouvoirs = new ArrayCollection();
        $this->PointsFort = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Pouvoirs>
     */
    public function getPouvoirs(): Collection
    {
        return $this->Pouvoirs;
    }

    public function addPouvoir(Pouvoirs $pouvoir): static
    {
        if (!$this->Pouvoirs->contains($pouvoir)) {
            $this->Pouvoirs->add($pouvoir);
        }

        return $this;
    }

    public function removePouvoir(Pouvoirs $pouvoir): static
    {
        $this->Pouvoirs->removeElement($pouvoir);

        return $this;
    }

    /**
     * @return Collection<int, PointsFort>
     */
    public function getPointsFort(): Collection
    {
        return $this->PointsFort;
    }

    public function addPointsFort(PointsFort $pointsFort): static
    {
        if (!$this->PointsFort->contains($pointsFort)) {
            $this->PointsFort->add($pointsFort);
        }

        return $this;
    }

    public function removePointsFort(PointsFort $pointsFort): static
    {
        $this->PointsFort->removeElement($pointsFort);

        return $this;
    }

}
