<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250108150710 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bien (id INT AUTO_INCREMENT NOT NULL, gouvernorat_id INT DEFAULT NULL, ville_id INT DEFAULT NULL, type_id INT DEFAULT NULL, nom_bien VARCHAR(255) NOT NULL, adresse_bien VARCHAR(255) NOT NULL, prix_bien VARCHAR(255) NOT NULL, type_offre VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, plan VARCHAR(255) DEFAULT NULL, video VARCHAR(255) DEFAULT NULL, localisation_bien VARCHAR(255) NOT NULL, afficher_prix TINYINT(1) NOT NULL, INDEX IDX_45EDC38675B74E2D (gouvernorat_id), INDEX IDX_45EDC386A73F0036 (ville_id), INDEX IDX_45EDC386C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE details_propriete (id INT AUTO_INCREMENT NOT NULL, propriete_id INT DEFAULT NULL, bien_id INT DEFAULT NULL, valeur_propriete VARCHAR(255) NOT NULL, INDEX IDX_9A8574818566CAF (propriete_id), INDEX IDX_9A85748BD95B80F (bien_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gouvernorat (id INT AUTO_INCREMENT NOT NULL, ville_id INT DEFAULT NULL, nom_gouvernorat VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, INDEX IDX_4457C12BA73F0036 (ville_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image_bien (id INT AUTO_INCREMENT NOT NULL, bien_id INT DEFAULT NULL, nom_image VARCHAR(255) NOT NULL, principal TINYINT(1) NOT NULL, INDEX IDX_B7D72918BD95B80F (bien_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nom_bien (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE propriete (id INT AUTO_INCREMENT NOT NULL, type_id INT DEFAULT NULL, nom_propriete VARCHAR(255) NOT NULL, INDEX IDX_73A85B93C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_bien (id INT AUTO_INCREMENT NOT NULL, nom_type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ville (id INT AUTO_INCREMENT NOT NULL, nom_ville VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bien ADD CONSTRAINT FK_45EDC38675B74E2D FOREIGN KEY (gouvernorat_id) REFERENCES gouvernorat (id)');
        $this->addSql('ALTER TABLE bien ADD CONSTRAINT FK_45EDC386A73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE bien ADD CONSTRAINT FK_45EDC386C54C8C93 FOREIGN KEY (type_id) REFERENCES type_bien (id)');
        $this->addSql('ALTER TABLE details_propriete ADD CONSTRAINT FK_9A8574818566CAF FOREIGN KEY (propriete_id) REFERENCES propriete (id)');
        $this->addSql('ALTER TABLE details_propriete ADD CONSTRAINT FK_9A85748BD95B80F FOREIGN KEY (bien_id) REFERENCES bien (id)');
        $this->addSql('ALTER TABLE gouvernorat ADD CONSTRAINT FK_4457C12BA73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE image_bien ADD CONSTRAINT FK_B7D72918BD95B80F FOREIGN KEY (bien_id) REFERENCES bien (id)');
        $this->addSql('ALTER TABLE propriete ADD CONSTRAINT FK_73A85B93C54C8C93 FOREIGN KEY (type_id) REFERENCES type_bien (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bien DROP FOREIGN KEY FK_45EDC38675B74E2D');
        $this->addSql('ALTER TABLE bien DROP FOREIGN KEY FK_45EDC386A73F0036');
        $this->addSql('ALTER TABLE bien DROP FOREIGN KEY FK_45EDC386C54C8C93');
        $this->addSql('ALTER TABLE details_propriete DROP FOREIGN KEY FK_9A8574818566CAF');
        $this->addSql('ALTER TABLE details_propriete DROP FOREIGN KEY FK_9A85748BD95B80F');
        $this->addSql('ALTER TABLE gouvernorat DROP FOREIGN KEY FK_4457C12BA73F0036');
        $this->addSql('ALTER TABLE image_bien DROP FOREIGN KEY FK_B7D72918BD95B80F');
        $this->addSql('ALTER TABLE propriete DROP FOREIGN KEY FK_73A85B93C54C8C93');
        $this->addSql('DROP TABLE bien');
        $this->addSql('DROP TABLE details_propriete');
        $this->addSql('DROP TABLE gouvernorat');
        $this->addSql('DROP TABLE image_bien');
        $this->addSql('DROP TABLE nom_bien');
        $this->addSql('DROP TABLE propriete');
        $this->addSql('DROP TABLE type_bien');
        $this->addSql('DROP TABLE ville');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
