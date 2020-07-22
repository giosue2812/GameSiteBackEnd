<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200720131336 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE editeur (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game (id INT AUTO_INCREMENT NOT NULL, id_editeur INT NOT NULL, id_genre INT NOT NULL, id_envie INT DEFAULT NULL, id_platform INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, prix DOUBLE PRECISION DEFAULT NULL, date_achat DATE DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, video LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\', INDEX IDX_232B318CDB3AEE9F (id_editeur), INDEX IDX_232B318C6DD572C8 (id_genre), INDEX IDX_232B318C7B179FFB (id_envie), INDEX IDX_232B318C69893C5E (id_platform), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genre (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE impression (id INT AUTO_INCREMENT NOT NULL, id_game INT DEFAULT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_245BB1B1A80B2D8E (id_game), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE liste_envie (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE platform (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318CDB3AEE9F FOREIGN KEY (id_editeur) REFERENCES editeur (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C6DD572C8 FOREIGN KEY (id_genre) REFERENCES genre (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C7B179FFB FOREIGN KEY (id_envie) REFERENCES liste_envie (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C69893C5E FOREIGN KEY (id_platform) REFERENCES platform (id)');
        $this->addSql('ALTER TABLE impression ADD CONSTRAINT FK_245BB1B1A80B2D8E FOREIGN KEY (id_game) REFERENCES game (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318CDB3AEE9F');
        $this->addSql('ALTER TABLE impression DROP FOREIGN KEY FK_245BB1B1A80B2D8E');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C6DD572C8');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C7B179FFB');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C69893C5E');
        $this->addSql('DROP TABLE editeur');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP TABLE impression');
        $this->addSql('DROP TABLE liste_envie');
        $this->addSql('DROP TABLE platform');
    }
}
