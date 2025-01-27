<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250125120935 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, tel INT NOT NULL, verifier TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bien DROP FOREIGN KEY FK_45EDC386C54C8C93');
        $this->addSql('ALTER TABLE bien ADD CONSTRAINT FK_45EDC386C54C8C93 FOREIGN KEY (type_id) REFERENCES type_bien (id)');
        $this->addSql('ALTER TABLE details_propriete DROP FOREIGN KEY FK_9A8574818566CAF');
        $this->addSql('ALTER TABLE details_propriete DROP FOREIGN KEY FK_9A85748BD95B80F');
        $this->addSql('ALTER TABLE details_propriete ADD CONSTRAINT FK_9A8574818566CAF FOREIGN KEY (propriete_id) REFERENCES propriete (id)');
        $this->addSql('ALTER TABLE details_propriete ADD CONSTRAINT FK_9A85748BD95B80F FOREIGN KEY (bien_id) REFERENCES bien (id)');
        $this->addSql('ALTER TABLE propriete DROP FOREIGN KEY FK_73A85B93C54C8C93');
        $this->addSql('ALTER TABLE propriete ADD CONSTRAINT FK_73A85B93C54C8C93 FOREIGN KEY (type_id) REFERENCES type_bien (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE bien DROP FOREIGN KEY FK_45EDC386C54C8C93');
        $this->addSql('ALTER TABLE bien ADD CONSTRAINT FK_45EDC386C54C8C93 FOREIGN KEY (type_id) REFERENCES type_bien (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE propriete DROP FOREIGN KEY FK_73A85B93C54C8C93');
        $this->addSql('ALTER TABLE propriete ADD CONSTRAINT FK_73A85B93C54C8C93 FOREIGN KEY (type_id) REFERENCES type_bien (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE details_propriete DROP FOREIGN KEY FK_9A8574818566CAF');
        $this->addSql('ALTER TABLE details_propriete DROP FOREIGN KEY FK_9A85748BD95B80F');
        $this->addSql('ALTER TABLE details_propriete ADD CONSTRAINT FK_9A8574818566CAF FOREIGN KEY (propriete_id) REFERENCES propriete (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE details_propriete ADD CONSTRAINT FK_9A85748BD95B80F FOREIGN KEY (bien_id) REFERENCES bien (id) ON UPDATE CASCADE ON DELETE CASCADE');
    }
}
