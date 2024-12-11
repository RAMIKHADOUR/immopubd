<?php

namespace App\Entity;

use DateTimeImmutable;
use App\Entity\Propertys;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\InfoPersoRepository;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: InfoPersoRepository::class)]
class InfoPerso
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $civilite = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(length: 50)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255,nullable: true)]
    private ?string $tele_fixe = null;

    #[ORM\Column(length: 255)]
    private ?string $tele_mobile = null;

    #[ORM\Column]
    private ?DateTimeImmutable $updatedAt = null;

    #[ORM\OneToOne(mappedBy: 'infosperso', cascade: ['persist', 'remove'])]
    private ?Propertys $propertys = null;

     public function __construct()
    {
        $this->updatedAt=new DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCivilite(): ?string
    {
        return $this->civilite;
    }

    public function setCivilite(string $civilite): self
    {
        $this->civilite = $civilite;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getTeleFixe(): ?string
    {
        return $this->tele_fixe;
    }

    public function setTeleFixe(string $tele_fixe): static
    {
        $this->tele_fixe = $tele_fixe;

        return $this;
    }

    public function getTeleMobile(): ?string
    {
        return $this->tele_mobile;
    }

    public function setTeleMobile(string $tele_mobile): static
    {
        $this->tele_mobile = $tele_mobile;

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
            $this->propertys->setInfosperso(null);
        }

        // set the owning side of the relation if necessary
        if ($propertys !== null && $propertys->getInfosperso() !== $this) {
            $propertys->setInfosperso($this);
        }

        $this->propertys = $propertys;

        return $this;
    }

}
