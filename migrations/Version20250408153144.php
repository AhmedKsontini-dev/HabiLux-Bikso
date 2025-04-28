<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250408153144 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE transaction CHANGE signature_vendeur signature_vendeur VARCHAR(255) DEFAULT NULL, CHANGE signature_acheteur signature_acheteur VARCHAR(255) DEFAULT NULL, CHANGE declaration1 declaration1 TINYINT(1) DEFAULT NULL, CHANGE declaration2 declaration2 TINYINT(1) DEFAULT NULL');
     
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE transaction CHANGE declaration1 declaration1 TINYINT(1) NOT NULL, CHANGE declaration2 declaration2 TINYINT(1) NOT NULL, CHANGE signature_vendeur signature_vendeur VARCHAR(255) NOT NULL, CHANGE signature_acheteur signature_acheteur VARCHAR(255) NOT NULL');
        
    }
}
