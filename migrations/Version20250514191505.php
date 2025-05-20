<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250514191505 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bien ADD disponibilite VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE details_propriete DROP FOREIGN KEY FK_9A85748BD95B80F');
        $this->addSql('ALTER TABLE details_propriete CHANGE bien_id bien_id INT NOT NULL');
        $this->addSql('ALTER TABLE details_propriete ADD CONSTRAINT FK_9A85748BD95B80F FOREIGN KEY (bien_id) REFERENCES bien (id) ON DELETE CASCADE');
        
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bien DROP disponibilite');
        $this->addSql('ALTER TABLE details_propriete DROP FOREIGN KEY FK_9A85748BD95B80F');
        $this->addSql('ALTER TABLE details_propriete CHANGE bien_id bien_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE details_propriete ADD CONSTRAINT FK_9A85748BD95B80F FOREIGN KEY (bien_id) REFERENCES bien (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        
    }
}
