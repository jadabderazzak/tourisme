<?php

namespace App\Entity;

use App\Entity\Images;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ListingRepository;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ListingRepository::class)]
class Listing
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'listings')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank(message: 'La localité ne doit pas être vide!')]
    private ?Localite $ville = null;

    #[ORM\ManyToOne(inversedBy: 'listings')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank(message: 'La catégorie ne doit pas être vide!')]
    private ?Categorie $categorie = null;

    #[ORM\Column(length: 400)]
    #[Assert\NotBlank(message: 'Le nom du listing ne doit pas être vide!')]
    #[Assert\Length(
        min : 2, 
        max : 399,
        minMessage : 'Vous devez saisir au moins 2 caractères',
        maxMessage : 'Vous ne devez pas dépasser 399 caractères'
        )]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $adresse = null;

    #[ORM\Column(type: Types::SMALLINT)]
    #[Assert\PositiveOrZero(message: 'Veuillez entrer un nombre positif')]
    private ?int $nbCouverts = null;

    #[ORM\Column(type: Types::SMALLINT)]
    #[Assert\PositiveOrZero(message: 'Veuillez entrer un nombre positif')]
    private ?int $nbChambre = null;

    #[ORM\Column(type: Types::SMALLINT)]
    #[Assert\PositiveOrZero(message: 'Veuillez entrer un nombre positif')]
    private ?int $nbLit = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $siteweb = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Email(
        message: 'l\'adresse Email {{ value }} n\'est pas une adresse valide.',
    )]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $telephone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $facebook = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $instagram = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tiktok = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $youtube = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $twitter = null;

    #[ORM\ManyToOne]
    private ?TypePension $pension = null;

    #[ORM\Column(length: 255)]
    #[Gedmo\Slug(fields:["name"])]
    private ?string $slug = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $latitude = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $longitude = null;

    #[ORM\Column(nullable: true)]
    private ?float $prixStart = null;

    #[ORM\Column(nullable: true)]
    private ?float $prixEnd = null;

    #[ORM\OneToMany(targetEntity: Images::class, mappedBy: 'listing')]
    private Collection $images;

    #[ORM\Column]
    private ?bool $afficher = null;

    #[ORM\OneToMany(targetEntity: Listingamnities::class, mappedBy: 'listing')]
    private Collection $listingamnities;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?float $note = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $video = null;

    #[ORM\OneToMany(targetEntity: Reviews::class, mappedBy: 'listing')]
    private Collection $reviews;

   

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->listingamnities = new ArrayCollection();
        $this->reviews = new ArrayCollection();
   
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVille(): ?Localite
    {
        return $this->ville;
    }

    public function setVille(?Localite $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getNbCouverts(): ?int
    {
        return $this->nbCouverts;
    }

    public function setNbCouverts(int $nbCouverts): static
    {
        $this->nbCouverts = $nbCouverts;

        return $this;
    }

    public function getNbChambre(): ?int
    {
        return $this->nbChambre;
    }

    public function setNbChambre(int $nbChambre): static
    {
        $this->nbChambre = $nbChambre;

        return $this;
    }

    public function getNbLit(): ?int
    {
        return $this->nbLit;
    }

    public function setNbLit(int $nbLit): static
    {
        $this->nbLit = $nbLit;

        return $this;
    }

    public function getSiteweb(): ?string
    {
        return $this->siteweb;
    }

    public function setSiteweb(?string $siteweb): static
    {
        $this->siteweb = $siteweb;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getFacebook(): ?string
    {
        return $this->facebook;
    }

    public function setFacebook(?string $facebook): static
    {
        $this->facebook = $facebook;

        return $this;
    }

    public function getInstagram(): ?string
    {
        return $this->instagram;
    }

    public function setInstagram(?string $instagram): static
    {
        $this->instagram = $instagram;

        return $this;
    }

    public function getTiktok(): ?string
    {
        return $this->tiktok;
    }

    public function setTiktok(?string $tiktok): static
    {
        $this->tiktok = $tiktok;

        return $this;
    }

    public function getYoutube(): ?string
    {
        return $this->youtube;
    }

    public function setYoutube(?string $youtube): static
    {
        $this->youtube = $youtube;

        return $this;
    }

    public function getTwitter(): ?string
    {
        return $this->twitter;
    }

    public function setTwitter(?string $twitter): static
    {
        $this->twitter = $twitter;

        return $this;
    }

    public function getPension(): ?TypePension
    {
        return $this->pension;
    }

    public function setPension(?TypePension $pension): static
    {
        $this->pension = $pension;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(?string $latitude): static
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(?string $longitude): static
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getPrixStart(): ?float
    {
        return $this->prixStart;
    }

    public function setPrixStart(?float $prixStart): static
    {
        $this->prixStart = $prixStart;

        return $this;
    }

    public function getPrixEnd(): ?float
    {
        return $this->prixEnd;
    }

    public function setPrixEnd(?float $prixEnd): static
    {
        $this->prixEnd = $prixEnd;

        return $this;
    }

    /**
     * @return Collection<int, Images>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Images $image): static
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setListing($this);
        }

        return $this;
    }

    public function removeImage(Images $image): static
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getListing() === $this) {
                $image->setListing(null);
            }
        }

        return $this;
    }

    public function isAfficher(): ?bool
    {
        return $this->afficher;
    }

    public function setAfficher(bool $afficher): static
    {
        $this->afficher = $afficher;

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
            $listingamnity->setListing($this);
        }

        return $this;
    }

    public function removeListingamnity(Listingamnities $listingamnity): static
    {
        if ($this->listingamnities->removeElement($listingamnity)) {
            // set the owning side to null (unless already changed)
            if ($listingamnity->getListing() === $this) {
                $listingamnity->setListing(null);
            }
        }

        return $this;
    }

    public function getFirstImage(): ?Images
    {
        return $this->images->first() ?: null;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getNote(): ?float
    {
        return $this->note;
    }

    public function setNote(?float $note): static
    {
        $this->note = $note;

        return $this;
    }

    public function getVideo(): ?string
    {
        return $this->video;
    }

    public function setVideo(?string $video): static
    {
        $this->video = $video;

        return $this;
    }

    /**
     * @return Collection<int, Reviews>
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function addReview(Reviews $review): static
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews->add($review);
            $review->setListing($this);
        }

        return $this;
    }

    public function removeReview(Reviews $review): static
    {
        if ($this->reviews->removeElement($review)) {
            // set the owning side to null (unless already changed)
            if ($review->getListing() === $this) {
                $review->setListing(null);
            }
        }

        return $this;
    }

  
}
