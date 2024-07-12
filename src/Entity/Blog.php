<?php

namespace App\Entity;

use App\Repository\BlogRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: BlogRepository::class)]
class Blog
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Le titre ne doit pas être vide!')]
    #[Assert\Length(
        min : 3, 
        max : 200,
        minMessage : 'Vous devez saisir au moins 3 caractères',
        maxMessage : 'Vous ne devez pas dépasser 200 caractères'
        )]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message: 'La description ne doit pas être vide!')]
    #[Assert\Length(
        min : 10, 
        max : 2000,
        minMessage : 'Vous devez saisir au moins 10 caractères',
        maxMessage : 'Vous ne devez pas dépasser 2000 caractères'
        )]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'blogs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(length: 255)]
    #[Gedmo\Slug(fields:["title"])]
    private ?string $slug = null;

    #[ORM\OneToMany(targetEntity: Commentsblog::class, mappedBy: 'blog')]
    private Collection $commentsblogs;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $video = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    public function __construct()
    {
        $this->commentsblogs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
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
     * @return Collection<int, Commentsblog>
     */
    public function getCommentsblogs(): Collection
    {
        return $this->commentsblogs;
    }

    public function addCommentsblog(Commentsblog $commentsblog): static
    {
        if (!$this->commentsblogs->contains($commentsblog)) {
            $this->commentsblogs->add($commentsblog);
            $commentsblog->setBlog($this);
        }

        return $this;
    }

    public function removeCommentsblog(Commentsblog $commentsblog): static
    {
        if ($this->commentsblogs->removeElement($commentsblog)) {
            // set the owning side to null (unless already changed)
            if ($commentsblog->getBlog() === $this) {
                $commentsblog->setBlog(null);
            }
        }

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }
}
