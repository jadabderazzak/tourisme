<?php

namespace App\Entity;

use App\Repository\ListingTagsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ListingTagsRepository::class)]
class ListingTags
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'listingTags')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Listing $listing = null;

    #[ORM\ManyToOne(inversedBy: 'listingTags')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Tags $tags = null;

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

    public function getTags(): ?Tags
    {
        return $this->tags;
    }

    public function setTags(?Tags $tags): static
    {
        $this->tags = $tags;

        return $this;
    }
}
