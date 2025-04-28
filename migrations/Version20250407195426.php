<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250407195426 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bien ADD nom_vendeur VARCHAR(255) NOT NULL, ADD tel_vendeur1 VARCHAR(255) NOT NULL, ADD adresse_vendeur VARCHAR(255) NOT NULL, DROP nom_acheteur, DROP tel_acheteur1, DROP adresse_acheteur, CHANGE tel_acheteur2 tel_vendeur2 VARCHAR(255) DEFAULT NULL');
       
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bien ADD nom_acheteur VARCHAR(255) NOT NULL, ADD tel_acheteur1 VARCHAR(255) NOT NULL, ADD adresse_acheteur VARCHAR(255) NOT NULL, DROP nom_vendeur, DROP tel_vendeur1, DROP adresse_vendeur, CHANGE tel_vendeur2 tel_acheteur2 VARCHAR(255) DEFAULT NULL');
        
    }
}
