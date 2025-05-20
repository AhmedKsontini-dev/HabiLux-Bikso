<?php

namespace App\Entity;

use App\Repository\DetailsProprieteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DetailsProprieteRepository::class)]
class DetailsPropriete
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $valeurPropriete = null;

    #[ORM\ManyToOne(inversedBy: 'detailsProprietes')]
    private ?propriete $propriete = null;

    #[ORM\ManyToOne(targetEntity: Bien::class, inversedBy: 'detailsProprietes')]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private ?bien $bien = null;

    #[ORM\Column(nullable: true)]
    private ?bool $afficher = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValeurPropriete(): ?string
    {
        return $this->valeurPropriete;
    }

    public function setValeurPropriete(string $valeurPropriete): static
    {
        $this->valeurPropriete = $valeurPropriete;

        return $this;
    }

    public function getPropriete(): ?propriete
    {
        return $this->propriete;
    }

    public function setPropriete(?propriete $propriete): static
    {
        $this->propriete = $propriete;

        return $this;
    }

    public function getBien(): ?bien
    {
        return $this->bien;
    }

    public function setBien(?bien $bien): static
    {
        $this->bien = $bien;

        return $this;
    }

    public function isAfficher(): ?bool
    {
        return $this->afficher;
    }

    public function setAfficher(?bool $afficher): static
    {
        $this->afficher = $afficher;

        return $this;
    }
}
