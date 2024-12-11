<?php

namespace App\Entity;

use App\Entity\Users;
use App\Entity\Medias;
use DateTimeImmutable;
use App\Entity\Propertys;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\AnnoncesRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AnnoncesRepository::class)]
class Annonces
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $reference = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column]
    private ?DateTimeImmutable $createdAt = null;
    
      #[ORM\OneToOne(targetEntity: Propertys::class, cascade: ['persist', 'remove'])]
    private ?Propertys $property = null;


    #[ORM\ManyToOne(inversedBy: 'annonces')]
    private ?Users $user = null;

    #[ORM\ManyToOne(inversedBy: 'annonces')]
    private ?Contacts $contact = null;

    public function __construct()
    {
        $this->createdAt= new DateTimeImmutable();
    
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): static
    {
        $this->reference = $reference;

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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getProperty(): ?Propertys
    {
        return $this->property;
    }

    public function setProperty(?Propertys $property): static
    {
        // unset the owning side of the relation if necessary
        if ($property === null && $this->property !== null) {
            $this->property->setAnnonce(null);
        }

        // set the owning side of the relation if necessary
        if ($property !== null && $property->getAnnonce() !== $this) {
            $property->setAnnonce($this);
        }

        $this->property = $property;

        return $this;
    }

    /**
     * @return Collection<int, Medias>
     */
    public function getMedias(): Collection
    {
        return $this->medias;
    }

    public function addMedia(Medias $media): static
    {
        if (!$this->medias->contains($media)) {
            $this->medias->add($media);
            $media->setAnnonce($this);
        }

        return $this;
    }

    public function removeMedia(Medias $media): static
    {
        if ($this->medias->removeElement($media)) {
            // set the owning side to null (unless already changed)
            if ($media->getAnnonce() === $this) {
                $media->setAnnonce(null);
            }
        }

        return $this;
    }

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getContact(): ?Contacts
    {
        return $this->contact;
    }

    public function setContact(?Contacts $contact): static
    {
        $this->contact = $contact;

        return $this;
    }
}

