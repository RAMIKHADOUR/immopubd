<?php

namespace App\Entity;

use App\Entity\Annonces;
use App\Entity\InfoPerso;
use App\Entity\Typesbien;
use App\Entity\Categorysbien;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PropertysRepository;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PropertysRepository::class)]
class Propertys
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?float $surface = null;

     #[ORM\Column]
    private ?float $prix = null;

    #[ORM\Column]
    private ?int $chambres = null;

    #[ORM\Column]
    private ?int $sallebains = null;

    #[ORM\Column]
    private ?int $etages = null;

    #[ORM\Column]
    private ?int $numero_etage = null;

    #[ORM\Column]
    private ?bool $internet = null;

    #[ORM\Column]
    private ?bool $garage = null;

    #[ORM\Column]
    private ?bool $piscine = null;

    #[ORM\Column]
    private ?bool $camera = null;

    #[ORM\OneToOne(targetEntity: Adresses::class, cascade: ['persist', 'remove'])]
    private ?Adresses $adresse = null;

    #[ORM\OneToOne(targetEntity: InfoPerso::class, cascade: ['persist', 'remove'])]
    private ?InfoPerso $infosperso = null;

     #[ORM\OneToOne(targetEntity: Annonces::class, cascade: ['persist', 'remove'])]
    private ?Annonces $annonce = null;

    #[ORM\ManyToOne(targetEntity: Categorysbien::class)]
    private ?Categorysbien $categorysbien = null;

    #[ORM\ManyToOne(targetEntity: Typesbien::class)]
    private ?Typesbien $typesbien = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getSurface(): ?float
    {
        return $this->surface;
    }

    public function setSurface(float $surface): static
    {
        $this->surface = $surface;

        return $this;
    }

    public function getChambres(): ?int
    {
        return $this->chambres;
    }

    public function setChambres(int $chambres): static
    {
        $this->chambres = $chambres;

        return $this;
    }

    public function getSallebains(): ?int
    {
        return $this->sallebains;
    }

    public function setSallebains(int $sallebains): static
    {
        $this->sallebains = $sallebains;

        return $this;
    }

    public function getEtages(): ?int
    {
        return $this->etages;
    }

    public function setEtages(int $etages): static
    {
        $this->etages = $etages;

        return $this;
    }

    public function getNumeroEtage(): ?int
    {
        return $this->numero_etage;
    }

    public function setNumeroEtage(int $numero_etage): static
    {
        $this->numero_etage = $numero_etage;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function isInternet(): ?bool
    {
        return $this->internet;
    }

    public function setInternet(bool $internet): static
    {
        $this->internet = $internet;

        return $this;
    }

    public function isGarage(): ?bool
    {
        return $this->garage;
    }

    public function setGarage(bool $garage): static
    {
        $this->garage = $garage;

        return $this;
    }

    public function isPiscine(): ?bool
    {
        return $this->piscine;
    }

    public function setPiscine(bool $piscine): static
    {
        $this->piscine = $piscine;

        return $this;
    }

    public function isCamera(): ?bool
    {
        return $this->camera;
    }

    public function setCamera(bool $camera): static
    {
        $this->camera = $camera;

        return $this;
    }

    public function getCategorysbien(): ?Categorysbien
    {
        return $this->categorysbien;
    }

    public function setCategorysbien(?Categorysbien $category): static
    {
        $this->categorysbien = $category;

        return $this;
    }

    public function getTypesbien(): ?Typesbien
    {
        return $this->typesbien;
    }

    public function setTypesbien(?Typesbien $typebien): static
    {
        $this->typesbien = $typebien;

        return $this;
    }

    public function getAdresse(): ?Adresses
    {
        return $this->adresse;
    }

    public function setAdresse(?Adresses $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getInfosperso(): ?InfoPerso
    {
        return $this->infosperso;
    }

    public function setInfosperso(?InfoPerso $infosperso): static
    {
        $this->infosperso = $infosperso;

        return $this;
    }

    public function getAnnonce(): ?Annonces
    {
        return $this->annonce;
    }

    public function setAnnonce(?Annonces $annonce): static
    {
        $this->annonce = $annonce;

        return $this;
    }
     public function __toString(): string
    {
      
        return $this->description;
      
    }


    /**
     * Get the value of prix
     *
     * @return ?float
     */
    public function getPrix(): ?float
    {
        return $this->prix;
    }

    /**
     * Set the value of prix
     *
     * @param ?float $prix
     *
     * @return self
     */
    public function setPrix(?float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }
}
