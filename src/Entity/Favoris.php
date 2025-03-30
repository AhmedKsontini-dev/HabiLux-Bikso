<?php

namespace App\Entity;

use App\Repository\FavorisRepository;
use Doctrine\ORM\Mapping as ORM;
use DateTimeImmutable;
use App\Entity\User;
use App\Entity\bien;

#[ORM\Entity(repositoryClass: FavorisRepository::class)]
class Favoris
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: "favoris")]
    #[ORM\JoinColumn(nullable: false, onDelete: "CASCADE")]
    private ?User $user = null;

    #[ORM\ManyToOne(targetEntity: Bien::class, inversedBy: "favoris")]
    #[ORM\JoinColumn(nullable: false, onDelete: "CASCADE")]
    private ?Bien $bien = null;

    #[ORM\Column(type: "datetime_immutable")]
    private ?DateTimeImmutable $dateAjout = null;

    public function __construct()
    {
        $this->dateAjout = new DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getBien(): ?Bien
    {
        return $this->bien;
    }

    public function setBien(?Bien $bien): static
    {
        $this->bien = $bien;
        return $this;
    }

    public function getDateAjout(): ?DateTimeImmutable
    {
        return $this->dateAjout;
    }
}
