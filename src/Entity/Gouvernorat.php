<?php

namespace App\Entity;

use App\Repository\GouvernoratRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GouvernoratRepository::class)]
class Gouvernorat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomGouvernorat = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    /**
     * @var Collection<int, bien>
     */
    #[ORM\OneToMany(targetEntity: bien::class, mappedBy: 'gouvernorat')]
    private Collection $bien;

    #[ORM\ManyToOne(inversedBy: 'gouvernorat')]
    private ?Ville $ville = null;

    public function __construct()
    {
        $this->bien = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomGouvernorat(): ?string
    {
        return $this->nomGouvernorat;
    }

    public function setNomGouvernorat(string $nomGouvernorat): static
    {
        $this->nomGouvernorat = $nomGouvernorat;

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

    /**
     * @return Collection<int, bien>
     */
    public function getBien(): Collection
    {
        return $this->bien;
    }

    public function addBien(bien $bien): static
    {
        if (!$this->bien->contains($bien)) {
            $this->bien->add($bien);
            $bien->setGouvernorat($this);
        }

        return $this;
    }

    public function removeBien(bien $bien): static
    {
        if ($this->bien->removeElement($bien)) {
            // set the owning side to null (unless already changed)
            if ($bien->getGouvernorat() === $this) {
                $bien->setGouvernorat(null);
            }
        }

        return $this;
    }

    public function getVille(): ?Ville
    {
        return $this->ville;
    }

    public function setVille(?Ville $ville): static
    {
        $this->ville = $ville;

        return $this;
    }
}
