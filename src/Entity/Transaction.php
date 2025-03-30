<?php

namespace App\Entity;

use App\Repository\TransactionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TransactionRepository::class)]
#[ORM\Table(name: "transaction")]
class Transaction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'transaction', cascade: ['persist', 'remove'])]
    private ?bien $bien = null;

    #[ORM\ManyToOne(inversedBy: 'transactions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $agent = null;

    #[ORM\Column(length: 255)]
    private ?string $nomAcheteur = null;

    #[ORM\Column(length: 255)]
    private ?string $telAcheteur = null;

    #[ORM\Column]
    private ?int $cinAcheteur = null;

    #[ORM\Column(length: 255)]
    private ?string $typeTransaction = null;

    #[ORM\Column(length: 255)]
    private ?string $prixInitial = null;

    #[ORM\Column(length: 255)]
    private ?string $prixFinal = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $commission = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateTransaction = null;

    #[ORM\Column(length: 255)]
    private ?string $modePaiement = null;

    #[ORM\Column]
    private ?string $nbrMois = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $prixParMois = null;

    #[ORM\Column(length: 255)]
    private ?string $payer = null;

    #[ORM\Column(length: 255)]
    private ?string $statutTransaction = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBien(): ?bien
    {
        return $this->bien;
    }

    public function setBien(bien $bien): static
    {
        $this->bien = $bien;

        return $this;
    }

    public function getAgent(): ?User
    {
        return $this->agent;
    }

    public function setAgent(?User $agent): static
    {
        $this->agent = $agent;

        return $this;
    }

    public function getNomAcheteur(): ?string
    {
        return $this->nomAcheteur;
    }

    public function setNomAcheteur(string $nomAcheteur): static
    {
        $this->nomAcheteur = $nomAcheteur;

        return $this;
    }

    public function getTelAcheteur(): ?string
    {
        return $this->telAcheteur;
    }

    public function setTelAcheteur(string $telAcheteur): static
    {
        $this->telAcheteur = $telAcheteur;

        return $this;
    }

    public function getCinAcheteur(): ?int
    {
        return $this->cinAcheteur;
    }

    public function setCinAcheteur(int $cinAcheteur): static
    {
        $this->cinAcheteur = $cinAcheteur;

        return $this;
    }

    public function getTypeTransaction(): ?string
    {
        return $this->typeTransaction;
    }

    public function setTypeTransaction(string $typeTransaction): static
    {
        $this->typeTransaction = $typeTransaction;

        return $this;
    }

    public function getPrixInitial(): ?string
    {
        return $this->prixInitial;
    }

    public function setPrixInitial(string $prixInitial): static
    {
        $this->prixInitial = $prixInitial;

        return $this;
    }

    public function getPrixFinal(): ?string
    {
        return $this->prixFinal;
    }

    public function setPrixFinal(string $prixFinal): static
    {
        $this->prixFinal = $prixFinal;

        return $this;
    }

    public function getCommission(): ?string
    {
        return $this->commission;
    }

    public function setCommission(?string $commission): static
    {
        $this->commission = $commission;

        return $this;
    }

    public function getDateTransaction(): ?\DateTimeInterface
    {
        return $this->dateTransaction;
    }

    public function setDateTransaction(\DateTimeInterface $dateTransaction): static
    {
        $this->dateTransaction = $dateTransaction;

        return $this;
    }

    public function getModePaiement(): ?string
    {
        return $this->modePaiement;
    }

    public function setModePaiement(string $modePaiement): static
    {
        $this->modePaiement = $modePaiement;

        return $this;
    }

    public function getNbrMois(): ?string
    {
        return $this->nbrMois;
    }

    public function setNbrMois(string $nbrMois): static
    {
        $this->nbrMois = $nbrMois;

        return $this;
    }

    public function getPrixParMois(): ?string
    {
        return $this->prixParMois;
    }

    public function setPrixParMois(?string $prixParMois): static
    {
        $this->prixParMois = $prixParMois;

        return $this;
    }

    public function getPayer(): ?string
    {
        return $this->payer;
    }

    public function setPayer(string $payer): static
    {
        $this->payer = $payer;

        return $this;
    }

    public function getStatutTransaction(): ?string
    {
        return $this->statutTransaction;
    }

    public function setStatutTransaction(string $statutTransaction): static
    {
        $this->statutTransaction = $statutTransaction;

        return $this;
    }
}
