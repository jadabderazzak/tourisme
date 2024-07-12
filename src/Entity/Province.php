<?php

namespace App\Entity;

use App\Repository\ProvinceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProvinceRepository::class)]
class Province
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Le nom de la province ne doit pas être vide!')]
    #[Assert\Length(
        min : 3, 
        max : 200,
        minMessage : 'Vous devez saisir au moins 2 caractères',
        maxMessage : 'Vous ne devez pas dépasser 200 caractères'
        )]
    private ?string $nom = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $nbVilles = null;

    #[ORM\Column(length: 255)]
    #[Gedmo\Slug(fields:["nom"])]
    private ?string $slug = null;

    #[ORM\OneToMany(targetEntity: Localite::class, mappedBy: 'province')]
    private Collection $localites;

    public function __construct()
    {
        $this->localites = new ArrayCollection();
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

    public function getNbVilles(): ?int
    {
        return $this->nbVilles;
    }

    public function setNbVilles(int $nbVilles): static
    {
        $this->nbVilles = $nbVilles;

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
     * @return Collection<int, Localite>
     */
    public function getLocalites(): Collection
    {
        return $this->localites;
    }

    public function addLocalite(Localite $localite): static
    {
        if (!$this->localites->contains($localite)) {
            $this->localites->add($localite);
            $localite->setProvince($this);
        }

        return $this;
    }

    public function removeLocalite(Localite $localite): static
    {
        if ($this->localites->removeElement($localite)) {
            // set the owning side to null (unless already changed)
            if ($localite->getProvince() === $this) {
                $localite->setProvince(null);
            }
        }

        return $this;
    }
}
