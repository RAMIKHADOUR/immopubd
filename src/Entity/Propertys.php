<?php

namespace App\Entity;

use App\Repository\PropertysRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

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

    #[ORM\ManyToOne(inversedBy: 'propertys')]
    private ?Categorysbien $category = null;

    #[ORM\ManyToOne(inversedBy: 'propertys')]
    private ?Typesbien $typebien = null;

    #[ORM\OneToOne(inversedBy: 'propertys', cascade: ['persist', 'remove'])]
    private ?Adresses $adresse = null;

    #[ORM\OneToOne(inversedBy: 'propertys', cascade: ['persist', 'remove'])]
    private ?InfoPerso $infosperso = null;

    #[ORM\OneToOne(inversedBy: 'propertys', cascade: ['persist', 'remove'])]
    private ?Annonces $annonce = null;

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

    public function getCategory(): ?Categorysbien
    {
        return $this->category;
    }

    public function setCategory(?Categorysbien $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getTypebien(): ?Typesbien
    {
        return $this->typebien;
    }

    public function setTypebien(?Typesbien $typebien): static
    {
        $this->typebien = $typebien;

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
}
