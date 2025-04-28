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

    #[ORM\ManyToOne(inversedBy: 'transactions', cascade: ['persist', 'remove'])]
    private ?bien $bien = null;



    #[ORM\Column(length: 255)]
    private ?string $nomAcheteur = null;

    #[ORM\Column(length: 255)]
    private ?string $nomVendeur = null;

    #[ORM\Column(length: 255)]
    private ?string $telAcheteur = null;

    #[ORM\Column]
    private ?int $cinAcheteur = null;

    #[ORM\Column(length: 255)]
    private ?string $typeTransaction = null;

    #[ORM\Column(length: 255)]
    private ?string $prixVente = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $commission = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateTransaction = null;

    #[ORM\Column(length: 255)]
    private ?string $modePaiement = null;

    #[ORM\Column(length: 255)]
    private ?string $payer = null;

    #[ORM\Column(length: 255)]
    private ?string $statutTransaction = null;

    #[ORM\Column(length: 255)]
    private ?string $adresseAcheteur = null;


    #[ORM\Column(length: 255)]
    private ?string $objetContrat = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $descriptionBien = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $debutLocation = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $finLocation = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $obligationVendeur = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $obligationAcheteur = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $conditionsResiliation = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $confidentialite = null;

    #[ORM\Column(length: 255)]
    private ?string $posteVendeur = null;

    #[ORM\Column(length: 255)]
    private ?string $telVendeur = null;

    #[ORM\Column(length: 255)]
    private ?string $mailVendeur = null;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $declaration1 = null;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $declaration2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $signatureVendeur = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $signatureAcheteur = null;


    #[ORM\ManyToOne(inversedBy: 'transactions')]
    private ?User $agent = null;


  


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


    public function getNomAcheteur(): ?string
    {
        return $this->nomAcheteur;
    }

    public function setNomAcheteur(string $nomAcheteur): static
    {
        $this->nomAcheteur = $nomAcheteur;

        return $this;
    }

    public function getNomVendeur(): ?string
    {
        return $this->nomVendeur;
    }

    public function setNomVendeur(string $nomVendeur): static
    {
        $this->nomVendeur = $nomVendeur;

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

    public function getAdresseAcheteur(): ?string
    {
        return $this->adresseAcheteur;
    }

    public function setAdresseAcheteur(string $adresseAcheteur): static
    {
        $this->adresseAcheteur = $adresseAcheteur;

        return $this;
    }


    public function getObjetContrat(): ?string
    {
        return $this->objetContrat;
    }

    public function setObjetContrat(string $objetContrat): static
    {
        $this->objetContrat = $objetContrat;

        return $this;
    }

    public function getDescriptionBien(): ?string
    {
        return $this->descriptionBien;
    }

    public function setDescriptionBien(string $descriptionBien): static
    {
        $this->descriptionBien = $descriptionBien;

        return $this;
    }

    public function getDebutLocation(): ?\DateTimeInterface
    {
        return $this->debutLocation;
    }

    public function setDebutLocation(?\DateTimeInterface $debutLocation): static
    {
        $this->debutLocation = $debutLocation;

        return $this;
    }

    public function getFinLocation(): ?\DateTimeInterface
    {
        return $this->finLocation;
    }

    public function setFinLocation(?\DateTimeInterface $finLocation): static
    {
        $this->finLocation = $finLocation;

        return $this;
    }

    public function getObligationVendeur(): ?string
    {
        return $this->obligationVendeur;
    }

    public function setObligationVendeur(string $obligationVendeur): static
    {
        $this->obligationVendeur = $obligationVendeur;

        return $this;
    }

    public function getObligationAcheteur(): ?string
    {
        return $this->obligationAcheteur;
    }

    public function setObligationAcheteur(string $obligationAcheteur): static
    {
        $this->obligationAcheteur = $obligationAcheteur;

        return $this;
    }

    public function getConditionsResiliation(): ?string
    {
        return $this->conditionsResiliation;
    }

    public function setConditionsResiliation(string $conditionsResiliation): static
    {
        $this->conditionsResiliation = $conditionsResiliation;

        return $this;
    }

    public function getConfidentialite(): ?string
    {
        return $this->confidentialite;
    }

    public function setConfidentialite(string $confidentialite): static
    {
        $this->confidentialite = $confidentialite;

        return $this;
    }

    public function getPosteVendeur(): ?string
    {
        return $this->posteVendeur;
    }

    public function setPosteVendeur(string $posteVendeur): static
    {
        $this->posteVendeur = $posteVendeur;

        return $this;
    }

    public function getTelVendeur(): ?string
    {
        return $this->telVendeur;
    }

    public function setTelVendeur(string $telVendeur): static
    {
        $this->telVendeur = $telVendeur;

        return $this;
    }

    public function getMailVendeur(): ?string
    {
        return $this->mailVendeur;
    }

    public function setMailVendeur(string $mailVendeur): static
    {
        $this->mailVendeur = $mailVendeur;

        return $this;
    }

    public function getDeclaration1(): bool
    {
        return $this->declaration1;
    }

    public function setDeclaration1(bool $declaration1): self
    {
        $this->declaration1 = $declaration1;
        return $this;
    }

    public function getDeclaration2(): bool
    {
        return $this->declaration2;
    }

    public function setDeclaration2(bool $declaration2): self
    {
        $this->declaration2 = $declaration2;
        return $this;
    }

    public function getSignatureVendeur(): ?string
    {
        return $this->signatureVendeur;
    }

    public function setSignatureVendeur(string $signatureVendeur): static
    {
        $this->signatureVendeur = $signatureVendeur;

        return $this;
    }

    public function getSignatureAcheteur(): ?string
    {
        return $this->signatureAcheteur;
    }

    public function setSignatureAcheteur(string $signatureAcheteur): static
    {
        $this->signatureAcheteur = $signatureAcheteur;

        return $this;
    }

    public function getPrixVente(): ?string
    {
        return $this->prixVente;
    }
    
    public function setPrixVente(?string $prixVente): self
    {
        $this->prixVente = $prixVente;
    
        return $this;
    }


}
