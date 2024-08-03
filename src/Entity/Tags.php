<?php

namespace App\Entity;

use App\Repository\TagsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: TagsRepository::class)]
class Tags
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(
        min : 3, 
        max : 254,
        minMessage : 'Vous devez saisir au moins 3 caractères',
        maxMessage : 'Vous ne devez pas dépasser 254 caractères'
        )]
    #[Assert\NotBlank(message: 'Le nom du tag ne doit pas être vide!')]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[Gedmo\Slug(fields:["nom"])]
    private ?string $slug = null;

    #[ORM\ManyToOne(inversedBy: 'tags')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank(message: 'La catégorie du tag ne doit pas être vide!')]
    private ?Categorytags $categorie = null;

    #[ORM\OneToMany(targetEntity: ListingTags::class, mappedBy: 'tags')]
    private Collection $listingTags;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ar = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $en = null;

    public function __construct()
    {
        $this->listingTags = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getCategorie(): ?Categorytags
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorytags $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection<int, ListingTags>
     */
    public function getListingTags(): Collection
    {
        return $this->listingTags;
    }

    public function addListingTag(ListingTags $listingTag): static
    {
        if (!$this->listingTags->contains($listingTag)) {
            $this->listingTags->add($listingTag);
            $listingTag->setTags($this);
        }

        return $this;
    }

    public function removeListingTag(ListingTags $listingTag): static
    {
        if ($this->listingTags->removeElement($listingTag)) {
            // set the owning side to null (unless already changed)
            if ($listingTag->getTags() === $this) {
                $listingTag->setTags(null);
            }
        }

        return $this;
    }

    public function getAr(): ?string
    {
        return $this->ar;
    }

    public function setAr(?string $ar): static
    {
        $this->ar = $ar;

        return $this;
    }

    public function getEn(): ?string
    {
        return $this->en;
    }

    public function setEn(?string $en): static
    {
        $this->en = $en;

        return $this;
    }
}
