<?php

namespace App\Entity;

use App\Repository\CategorytagsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CategorytagsRepository::class)]
class Categorytags
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Le nom de la catégorie tags ne doit pas être vide!')]
    #[Assert\Length(
        min : 3, 
        max : 254,
        minMessage : 'Vous devez saisir au moins 3 caractères',
        maxMessage : 'Vous ne devez pas dépasser 254 caractères'
        )]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[Gedmo\Slug(fields:["nom"])]
    private ?string $slug = null;

    #[ORM\OneToMany(targetEntity: Tags::class, mappedBy: 'categorie')]
    private Collection $tags;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
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
     * @return Collection<int, Tags>
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tags $tag): static
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
            $tag->setCategorie($this);
        }

        return $this;
    }

    public function removeTag(Tags $tag): static
    {
        if ($this->tags->removeElement($tag)) {
            // set the owning side to null (unless already changed)
            if ($tag->getCategorie() === $this) {
                $tag->setCategorie(null);
            }
        }

        return $this;
    }
}
