<?php

namespace App\Entity;

use App\Enum\PersonnagesEtat;
use App\Repository\PersonnagesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PersonnagesRepository::class)]
class Personnages
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\OneToOne(targetEntity: Stand::class)]
    #[ORM\JoinColumn(nullable: true)]
    private ?Stand $stand = null;

    #[ORM\ManyToMany(targetEntity: Saisons::class)]
    private Collection $saisons;

    #[ORM\ManyToOne(inversedBy: 'personnages')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Statut $statut = null;

    #[ORM\Column(length: 60, enumType: PersonnagesEtat::class)]
    private ?PersonnagesEtat $enumType = null;

    #[ORM\OneToMany(mappedBy: 'personnages', targetEntity: Poses::class, cascade: ['persist', 'remove'])]
    private Collection $Poses;

    public function __construct()
    {
        $this->saisons = new ArrayCollection();
        $this->Poses = new ArrayCollection();
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getStand(): ?stand
    {
        return $this->stand;
    }

    public function setStand(?stand $stand): static
    {
        $this->stand = $stand;

        return $this;
    }

    /**
     * @return Collection<int, saisons>
     */
    public function getSaisons(): Collection
    {
        return $this->saisons;
    }

    public function addSaison(saisons $saison): static
    {
        if (!$this->saisons->contains($saison)) {
            $this->saisons->add($saison);
        }

        return $this;
    }

    public function removeSaison(saisons $saison): static
    {
        $this->saisons->removeElement($saison);

        return $this;
    }

    public function getStatut(): ?Statut
    {
        return $this->statut;
    }

    public function setStatut(?Statut $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getEnumType(): ?PersonnagesEtat
    {
        return $this->enumType;
    }

    public function setEnumType(PersonnagesEtat $enumType): static
    {
        $this->enumType = $enumType;

        return $this;
    }

    /**
     * @return Collection<int, Poses>
     */
    public function getPoses(): Collection
    {
        return $this->Poses;
    }

    public function addPose(Poses $pose): static
    {
        if (!$this->Poses->contains($pose)) {
            $this->Poses->add($pose);
            $pose->setPersonnages($this);
        }

        return $this;
    }

    public function removePose(Poses $pose): static
    {
        if ($this->Poses->removeElement($pose)) {
            // set the owning side to null (unless already changed)
            if ($pose->getPersonnages() === $this) {
                $pose->setPersonnages(null);
            }
        }

        return $this;
    }


}
