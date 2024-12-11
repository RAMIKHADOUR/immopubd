<?php

namespace App\Entity;

use DateTimeImmutable;
use App\Entity\Propertys;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\AdressesRepository;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AdressesRepository::class)]
class Adresses
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $numero_voie = null;

    #[ORM\Column(length: 255)]
    private ?string $voie = null;

    #[ORM\Column(length: 100)]
    private ?string $type_voie = null;

    #[ORM\Column(length: 100)]
    private ?string $ville = null;

    #[ORM\Column(length: 255)]
    private ?string $code_postale = null;

    #[ORM\Column(length: 255)]
    private ?string $region = null;

    #[ORM\Column]
    private ?DateTimeImmutable $updatedAt = null;

    #[ORM\OneToOne(mappedBy: 'adresse', cascade: ['persist', 'remove'])]
    private ?Propertys $propertys = null;

     public function __construct()
    {
        $this->updatedAt=new DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroVoie(): ?int
    {
        return $this->numero_voie;
    }

    public function setNumeroVoie(int $numero_voie): static
    {
        $this->numero_voie = $numero_voie;

        return $this;
    }

    public function getVoie(): ?string
    {
        return $this->voie;
    }

    public function setVoie(string $voie): static
    {
        $this->voie = $voie;

        return $this;
    }

    public function getTypeVoie(): ?string
    {
        return $this->type_voie;
    }

    public function setTypeVoie(string $type_voie): static
    {
        $this->type_voie = $type_voie;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    public function getCodePostale(): ?string
    {
        return $this->code_postale;
    }

    public function setCodePostale(string $code_postale): static
    {
        $this->code_postale = $code_postale;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(string $region): static
    {
        $this->region = $region;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getPropertys(): ?Propertys
    {
        return $this->propertys;
    }

    public function setPropertys(?Propertys $propertys): static
    {
        // unset the owning side of the relation if necessary
        if ($propertys === null && $this->propertys !== null) {
            $this->propertys->setAdresse(null);
        }

        // set the owning side of the relation if necessary
        if ($propertys !== null && $propertys->getAdresse() !== $this) {
            $propertys->setAdresse($this);
        }

        $this->propertys = $propertys;

        return $this;
    }
}
