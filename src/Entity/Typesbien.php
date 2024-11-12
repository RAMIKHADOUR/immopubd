<?php

namespace App\Entity;

use App\Repository\TypesbienRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypesbienRepository::class)]
class Typesbien
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $type_bien = null;

    /**
     * @var Collection<int, Propertys>
     */
    #[ORM\OneToMany(targetEntity: Propertys::class, mappedBy: 'typebien')]
    private Collection $propertys;

    public function __construct()
    {
        $this->propertys = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeBien(): ?string
    {
        return $this->type_bien;
    }

    public function setTypeBien(string $type_bien): static
    {
        $this->type_bien = $type_bien;

        return $this;
    }

    /**
     * @return Collection<int, Propertys>
     */
    public function getPropertys(): Collection
    {
        return $this->propertys;
    }

    public function addProperty(Propertys $property): static
    {
        if (!$this->propertys->contains($property)) {
            $this->propertys->add($property);
            $property->setTypebien($this);
        }

        return $this;
    }

    public function removeProperty(Propertys $property): static
    {
        if ($this->propertys->removeElement($property)) {
            // set the owning side to null (unless already changed)
            if ($property->getTypebien() === $this) {
                $property->setTypebien(null);
            }
        }

        return $this;
    }
}
