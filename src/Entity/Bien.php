<?php

namespace App\Entity;

use App\Repository\BienRepository;
use App\Entity\TypeBien;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BienRepository::class)]
class Bien
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomBien = null;

    #[ORM\Column(length: 255)]
    private ?string $adresseBien = null;

    #[ORM\Column(type: 'integer')]
    private ?int $prixBien = null;

    #[ORM\Column(length: 255)]
    private ?string $typeOffre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?bool $AfficherPrix = null;

    #[ORM\ManyToOne(inversedBy: 'bien')]
    private ?Gouvernorat $gouvernorat = null;

    #[ORM\ManyToOne(inversedBy: 'biens')]
    private ?Ville $ville = null;

    #[ORM\ManyToOne(inversedBy: 'biens')]
    private ?typeBien $type = null;

    /**
     * @var Collection<int, DetailsPropriete>
     */
    #[ORM\OneToMany(targetEntity: DetailsPropriete::class, mappedBy: 'bien')]
    private Collection $detailsProprietes;

    /**
     * @var Collection<int, ImageBien>
     */
    #[ORM\OneToMany(targetEntity: ImageBien::class, mappedBy: 'bien', cascade: ['persist', 'remove'])]
    private Collection $imageBiens;

    
    #[ORM\OneToMany(targetEntity: Favoris::class, mappedBy: 'bien')]
    private collection $favoris;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateCreation = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $publierPar = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $positionMap = null;

    #[ORM\Column(length: 255)]
    private ?string $nomProprietaire = null;

    #[ORM\Column(length: 255)]
    private ?string $telProprietaire1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $telProprietaire2 = null;

    #[ORM\Column(length: 255)]
    private ?string $adresseProprietaire = null;

    #[ORM\Column(type: "boolean", options: ["default" => true])]
    private bool $bienAfficher = true;


    #[ORM\OneToMany(mappedBy: 'bien', targetEntity: Transaction::class, orphanRemoval: true)]
    private ?Collection $transactions = null;

   
    
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $youtubeId = null;






 



    public function __construct()
    {
        $this->imageBiens = new ArrayCollection();
        $this->dateCreation = new \DateTime();
        $this->favoris = new ArrayCollection();
        $this->transactions = new ArrayCollection();
    }

    public function setCreationDate(): void
    {
        if ($this->dateCreation === null) {
            $this->dateCreation = new \DateTime();
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomBien(): ?string
    {
        return $this->nomBien;
    }

    public function setNomBien(string $nomBien): static
    {
        $this->nomBien = $nomBien;

        return $this;
    }



    public function getAdresseBien(): ?string
    {
        return $this->adresseBien;
    }

    public function setAdresseBien(string $adresseBien): static
    {
        $this->adresseBien = $adresseBien;

        return $this;
    }

    public function getPrixBien(): ?int
    {
        return $this->prixBien;
    }

    public function setPrixBien(int $prixBien): static
    {
        $this->prixBien = $prixBien;
        return $this;
    }

    public function getTypeOffre(): ?string
    {
        return $this->typeOffre;
    }

    public function setTypeOffre(string $typeOffre): static
    {
        $this->typeOffre = $typeOffre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }


    public function isAfficherPrix(): ?bool
    {
        return $this->AfficherPrix;
    }

    public function setAfficherPrix(bool $AfficherPrix): static
    {
        $this->AfficherPrix = $AfficherPrix;

        return $this;
    }

    public function getGouvernorat(): ?Gouvernorat
    {
        return $this->gouvernorat;
    }

    public function setGouvernorat(?Gouvernorat $gouvernorat): static
    {
        $this->gouvernorat = $gouvernorat;

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

    public function getType(): ?typeBien
    {
        return $this->type;
    }

    public function setType(?typeBien $type): static
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
            $detailsPropriete->setBien($this);
        }

        return $this;
    }

    public function removeDetailsPropriete(DetailsPropriete $detailsPropriete): static
    {
        if ($this->detailsProprietes->removeElement($detailsPropriete)) {
            // set the owning side to null (unless already changed)
            if ($detailsPropriete->getBien() === $this) {
                $detailsPropriete->setBien(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ImageBien>
     */
    public function getImageBiens(): Collection
    {
        return $this->imageBiens;
    }

    public function addImageBien(ImageBien $imageBien): static
    {
        if (!$this->imageBiens->contains($imageBien)) {
            $this->imageBiens->add($imageBien);
            $imageBien->setBien($this);
        }

        return $this;
    }

    public function removeImageBien(ImageBien $imageBien): static
    {
        if ($this->imageBiens->removeElement($imageBien)) {
            // set the owning side to null (unless already changed)
            if ($imageBien->getBien() === $this) {
                $imageBien->setBien(null);
            }
        }

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(?\DateTimeInterface $dateCreation): static
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getPublierPar(): ?User
    {
        return $this->publierPar;
    }

    public function setPublierPar(?User $user): self
    {
        $this->publierPar = $user;
        return $this;
    }

    public function getPositionMap(): ?string
    {
        return $this->positionMap;
    }

    public function setPositionMap(?string $positionMap): static
    {
        $this->positionMap = $positionMap;

        return $this;
    }


    public function getNomProprietaire(): ?string
    {
        return $this->nomProprietaire;
    }

    public function setNomProprietaire(string $nomProprietaire): static
    {
        $this->nomProprietaire = $nomProprietaire;

        return $this;
    }

    public function getTelProprietaire1(): ?string
    {
        return $this->telProprietaire1;
    }

    public function setTelProprietaire1(string $telProprietaire1): static
    {
        $this->telProprietaire1 = $telProprietaire1;

        return $this;
    }

    public function getTelProprietaire2(): ?string
    {
        return $this->telProprietaire2;
    }

    public function setTelProprietaire2(?string $telProprietaire2): static
    {
        $this->telProprietaire2 = $telProprietaire2;

        return $this;
    }

    public function getAdresseProprietaire(): ?string
    {
        return $this->adresseProprietaire;
    }

    public function setAdresseProprietaire(string $adresseProprietaire): static
    {
        $this->adresseProprietaire = $adresseProprietaire;

        return $this;
    }

    public function isBienAfficher(): bool
    {
        return $this->bienAfficher;
    }

    public function setBienAfficher(bool $bienAfficher): static
    {
        $this->bienAfficher = $bienAfficher;
        return $this;
    }

    public function getTransactions(): ?Collection
    {
        return $this->transactions;
    }

    public function setTransactions(?Collection $transactions): self
    {
        $this->transactions = $transactions;

        return $this;
    }

    public function getYoutubeId(): ?string
    {
        return $this->youtubeId;
    }

    public function setYoutubeId(?string $youtubeId): self
    {
        $this->youtubeId = $youtubeId;
        return $this;
    }








}
