<?php

namespace App\Entity;

use App\Repository\BesoinUserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BesoinUserRepository::class)]
class BesoinUser
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    private ?User $user = null;

    #[ORM\Column(length: 255)]
    private ?string $villeBien = null;

    #[ORM\Column(length: 255)]
    private ?string $gouvernoratBien = null;

    #[ORM\Column(length: 255)]
    private ?string $typeBien = null;

    #[ORM\Column(type: 'float')]
    private ?float $prixMin = null;

    #[ORM\Column(type: 'float')]
    private ?float $prixMax = null;

    // === Getters et Setters ===

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getVilleBien(): ?string
    {
        return $this->villeBien;
    }

    public function setVilleBien(string $villeBien): self
    {
        $this->villeBien = $villeBien;

        return $this;
    }

    public function getGouvernoratBien(): ?string
    {
        return $this->gouvernoratBien;
    }

    public function setGouvernoratBien(string $gouvernoratBien): self
    {
        $this->gouvernoratBien = $gouvernoratBien;

        return $this;
    }

    public function getTypeBien(): ?string
    {
        return $this->typeBien;
    }

    public function setTypeBien(string $typeBien): self
    {
        $this->typeBien = $typeBien;

        return $this;
    }

    public function getPrixMin(): ?float
    {
        return $this->prixMin;
    }

    public function setPrixMin(float $prixMin): self
    {
        $this->prixMin = $prixMin;

        return $this;
    }

    public function getPrixMax(): ?float
    {
        return $this->prixMax;
    }

    public function setPrixMax(float $prixMax): self
    {
        $this->prixMax = $prixMax;

        return $this;
    }
}
