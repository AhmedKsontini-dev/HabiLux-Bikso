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

    #[ORM\ManyToOne(inversedBy: 'detailsProprietes')]
    private ?bien $bien = null;

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
}
