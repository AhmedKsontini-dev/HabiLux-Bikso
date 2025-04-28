<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250408012845 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bien ADD nom_proprietaire VARCHAR(255) NOT NULL, ADD tel_proprietaire1 VARCHAR(255) NOT NULL, ADD adresse_proprietaire VARCHAR(255) NOT NULL, DROP nom_vendeur, DROP tel_vendeur1, DROP adresse_vendeur, CHANGE tel_vendeur2 tel_proprietaire2 VARCHAR(255) DEFAULT NULL');
       
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bien ADD nom_vendeur VARCHAR(255) NOT NULL, ADD tel_vendeur1 VARCHAR(255) NOT NULL, ADD adresse_vendeur VARCHAR(255) NOT NULL, DROP nom_proprietaire, DROP tel_proprietaire1, DROP adresse_proprietaire, CHANGE tel_proprietaire2 tel_vendeur2 VARCHAR(255) DEFAULT NULL');
        
    }
}
