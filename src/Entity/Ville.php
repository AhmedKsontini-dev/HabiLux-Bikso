<?php

namespace App\Entity;

use App\Repository\VilleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VilleRepository::class)]
class Ville
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomVille = null;

    /**
     * @var Collection<int, gouvernorat>
     */
    #[ORM\OneToMany(targetEntity: gouvernorat::class, mappedBy: 'ville')]
    private Collection $gouvernorat;

    /**
     * @var Collection<int, Bien>
     */
    #[ORM\OneToMany(targetEntity: Bien::class, mappedBy: 'ville')]
    private Collection $biens;

    public function __construct()
    {
        $this->gouvernorat = new ArrayCollection();
        $this->biens = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomVille(): ?string
    {
        return $this->nomVille;
    }

    public function setNomVille(string $nomVille): static
    {
        $this->nomVille = $nomVille;

        return $this;
    }

    /**
     * @return Collection<int, gouvernorat>
     */
    public function getGouvernorat(): Collection
    {
        return $this->gouvernorat;
    }

    public function addGouvernorat(gouvernorat $gouvernorat): static
    {
        if (!$this->gouvernorat->contains($gouvernorat)) {
            $this->gouvernorat->add($gouvernorat);
            $gouvernorat->setVille($this);
        }

        return $this;
    }

    public function removeGouvernorat(gouvernorat $gouvernorat): static
    {
        if ($this->gouvernorat->removeElement($gouvernorat)) {
            // set the owning side to null (unless already changed)
            if ($gouvernorat->getVille() === $this) {
                $gouvernorat->setVille(null);
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
            $bien->setVille($this);
        }

        return $this;
    }

    public function removeBien(Bien $bien): static
    {
        if ($this->biens->removeElement($bien)) {
            // set the owning side to null (unless already changed)
            if ($bien->getVille() === $this) {
                $bien->setVille(null);
            }
        }

        return $this;
    }
}
