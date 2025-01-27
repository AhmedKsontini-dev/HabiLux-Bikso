<?php

namespace App\Entity;

use App\Repository\TypeBienRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeBienRepository::class)]
class TypeBien
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomType = null;

    /**
     * @var Collection<int, Bien>
     */
    #[ORM\OneToMany(targetEntity: Bien::class, mappedBy: 'type')]
    private Collection $biens;

    /**
     * @var Collection<int, Propriete>
     */
    #[ORM\OneToMany(targetEntity: Propriete::class, mappedBy: 'type')]
    private Collection $proprietes;

    public function __construct()
    {
        $this->biens = new ArrayCollection();
        $this->proprietes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomType(): ?string
    {
        return $this->nomType;
    }

    public function setNomType(string $nomType): static
    {
        $this->nomType = $nomType;

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
            $bien->setType($this);
        }

        return $this;
    }

    public function removeBien(Bien $bien): static
    {
        if ($this->biens->removeElement($bien)) {
            // set the owning side to null (unless already changed)
            if ($bien->getType() === $this) {
                $bien->setType(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Propriete>
     */
    public function getProprietes(): Collection
    {
        return $this->proprietes;
    }

    public function addPropriete(Propriete $propriete): static
    {
        if (!$this->proprietes->contains($propriete)) {
            $this->proprietes->add($propriete);
            $propriete->setType($this);
        }

        return $this;
    }

    public function removePropriete(Propriete $propriete): static
    {
        if ($this->proprietes->removeElement($propriete)) {
            // set the owning side to null (unless already changed)
            if ($propriete->getType() === $this) {
                $propriete->setType(null);
            }
        }

        return $this;
    }
}
