<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250406154745 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bien ADD nom_acheteur VARCHAR(255) NOT NULL, ADD tel_acheteur1 VARCHAR(255) NOT NULL, ADD adresse_acheteur VARCHAR(255) NOT NULL, ADD bien_afficher TINYINT(1) DEFAULT 1 NOT NULL, DROP nom_client, DROP tel_client, DROP adresse_client, CHANGE tel_client2 tel_acheteur2 VARCHAR(255) DEFAULT NULL');
     
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bien ADD nom_client VARCHAR(255) NOT NULL, ADD tel_client VARCHAR(255) NOT NULL, ADD adresse_client VARCHAR(255) NOT NULL, DROP nom_acheteur, DROP tel_acheteur1, DROP adresse_acheteur, DROP bien_afficher, CHANGE tel_acheteur2 tel_client2 VARCHAR(255) DEFAULT NULL');
      
    }
}
