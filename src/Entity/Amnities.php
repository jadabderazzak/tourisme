<?php

namespace App\Entity;

use App\Repository\AmnitiesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AmnitiesRepository::class)]
class Amnities
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Le nom ne doit pas être vide!')]
    #[Assert\Length(
        min : 2, 
        max : 200,
        minMessage : 'Vous devez saisir au moins 2 caractères',
        maxMessage : 'Vous ne devez pas dépasser 200 caractères'
        )]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[Gedmo\Slug(fields:["nom"])]
    private ?string $slug = null;

    #[ORM\OneToMany(targetEntity: Listingamnities::class, mappedBy: 'amnities')]
    private Collection $listingamnities;

    public function __construct()
    {
        $this->listingamnities = new ArrayCollection();
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

    /**
     * @return Collection<int, Listingamnities>
     */
    public function getListingamnities(): Collection
    {
        return $this->listingamnities;
    }

    public function addListingamnity(Listingamnities $listingamnity): static
    {
        if (!$this->listingamnities->contains($listingamnity)) {
            $this->listingamnities->add($listingamnity);
            $listingamnity->setAmnities($this);
        }

        return $this;
    }

    public function removeListingamnity(Listingamnities $listingamnity): static
    {
        if ($this->listingamnities->removeElement($listingamnity)) {
            // set the owning side to null (unless already changed)
            if ($listingamnity->getAmnities() === $this) {
                $listingamnity->setAmnities(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getNom();
    }

  
}
