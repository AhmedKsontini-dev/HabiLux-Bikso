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

    /**
     * @var Collection<int, Ville>
     */
    #[ORM\OneToMany(targetEntity: Ville::class, mappedBy: 'gouvernorat')]
    private Collection $villes;

    /**
     * @var Collection<int, Bien>
     */
    #[ORM\OneToMany(targetEntity: Bien::class, mappedBy: 'gouvernorat')]
    private Collection $biens;

    public function __construct()
    {
        $this->villes = new ArrayCollection();
        $this->biens = new ArrayCollection();
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

    /**
     * @return Collection<int, Ville>
     */
    public function getVilles(): Collection
    {
        return $this->villes;
    }

    public function addVille(Ville $ville): static
    {
        if (!$this->villes->contains($ville)) {
            $this->villes->add($ville);
            $ville->setGouvernorat($this);
        }

        return $this;
    }

    public function removeVille(Ville $ville): static
    {
        if ($this->villes->removeElement($ville)) {
            // set the owning side to null (unless already changed)
            if ($ville->getGouvernorat() === $this) {
                $ville->setGouvernorat(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Bien>
     */
    public function getBiens(): Collection
    {
        return $this->biens;
    }

    public function addBien(Bien $bien): static
    {
        if (!$this->biens->contains($bien)) {
            $this->biens->add($bien);
            $bien->setGouvernorat($this);
        }

        return $this;
    }

    public function removeBien(Bien $bien): static
    {
        if ($this->biens->removeElement($bien)) {
            // set the owning side to null (unless already changed)
            if ($bien->getGouvernorat() === $this) {
                $bien->setGouvernorat(null);
            }
        }

        return $this;
    }
}
