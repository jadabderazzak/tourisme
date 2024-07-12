<?php

namespace App\Entity;

use App\Repository\CommentsblogRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: CommentsblogRepository::class)]
class Commentsblog
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'commentsblogs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Blog $blog = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Vore nom ne doit pas être vide!')]
    #[Assert\Length(
        min : 3, 
        max : 200,
        minMessage : 'Vous devez saisir au moins 3 caractères',
        maxMessage : 'Vous ne devez pas dépasser 200 caractères'
        )]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank(message: 'Vore adresse Email ne doit pas être vide!')]
    #[Assert\Email(
        message: 'Cette adresse Email n\'est pas valide!',
    )]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Url(
        message: 'The url {{ value }} is not a valid url',
    )]
    private ?string $website = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message: 'Le champs commentaire ne doit pas être vide!')]
    #[Assert\Length(
        min : 2, 
        max : 2000,
        minMessage : 'Vous devez saisir au moins 2 caractères',
        maxMessage : 'Vous ne devez pas dépasser 2000 caractères'
        )]
    private ?string $commentaire = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $commentedAt = null;

    #[ORM\Column]
    private ?bool $display = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBlog(): ?Blog
    {
        return $this->blog;
    }

    public function setBlog(?Blog $blog): static
    {
        $this->blog = $blog;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): static
    {
        $this->website = $website;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): static
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getCommentedAt(): ?\DateTimeInterface
    {
        return $this->commentedAt;
    }

    public function setCommentedAt(\DateTimeInterface $commentedAt): static
    {
        $this->commentedAt = $commentedAt;

        return $this;
    }

    public function isDisplay(): ?bool
    {
        return $this->display;
    }

    public function setDisplay(bool $display): static
    {
        $this->display = $display;

        return $this;
    }
}
