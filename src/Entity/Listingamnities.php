<?php

namespace App\Entity;

use App\Repository\ListingamnitiesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ListingamnitiesRepository::class)]
class Listingamnities
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'listingamnities')]
    private ?Listing $listing = null;

    #[ORM\ManyToOne(inversedBy: 'listingamnities')]
    private ?Amnities $amnities = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getListing(): ?Listing
    {
        return $this->listing;
    }

    public function setListing(?Listing $listing): static
    {
        $this->listing = $listing;

        return $this;
    }

    public function getAmnities(): ?Amnities
    {
        return $this->amnities;
    }

    public function setAmnities(?Amnities $amnities): static
    {
        $this->amnities = $amnities;

        return $this;
    }
}
