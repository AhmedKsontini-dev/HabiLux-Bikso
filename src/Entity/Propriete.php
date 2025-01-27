<?php

namespace App\Entity;

use App\Repository\ProprieteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProprieteRepository::class)]
class Propriete
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomPropriete = null;

    #[ORM\ManyToOne(inversedBy: 'proprietes')]
    private ?TypeBien $type = null;

    /**
     * @var Collection<int, DetailsPropriete>
     */
    #[ORM\OneToMany(targetEntity: DetailsPropriete::class, mappedBy: 'propriete')]
    private Collection $detailsProprietes;

    public function __construct()
    {
        $this->detailsProprietes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPropriete(): ?string
    {
        return $this->nomPropriete;
    }

    public function setNomPropriete(string $nomPropriete): static
    {
        $this->nomPropriete = $nomPropriete;

        return $this;
    }

    public function getType(): ?TypeBien
    {
        return $this->type;
    }

    public function setType(?TypeBien $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, DetailsPropriete>
     */
    public function getDetailsProprietes(): Collection
    {
        return $this->detailsProprietes;
    }

    public function addDetailsPropriete(DetailsPropriete $detailsPropriete): static
    {
        if (!$this->detailsProprietes->contains($detailsPropriete)) {
            $this->detailsProprietes->add($detailsPropriete);
            $detailsPropriete->setPropriete($this);
        }

        return $this;
    }

    public function removeDetailsPropriete(DetailsPropriete $detailsPropriete): static
    {
        if ($this->detailsProprietes->removeElement($detailsPropriete)) {
            // set the owning side to null (unless already changed)
            if ($detailsPropriete->getPropriete() === $this) {
                $detailsPropriete->setPropriete(null);
            }
        }

        return $this;
    }
}
