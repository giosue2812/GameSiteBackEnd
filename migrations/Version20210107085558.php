<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210107085558 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE editeur (id INT AUTO_INCREMENT NOT NULL, create_date DATE NOT NULL, update_date DATE DEFAULT NULL, is_active TINYINT(1) NOT NULL, label VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game (id INT AUTO_INCREMENT NOT NULL, id_editeur INT NOT NULL, id_genre INT NOT NULL, id_platform INT DEFAULT NULL, create_date DATE NOT NULL, update_date DATE DEFAULT NULL, is_active TINYINT(1) NOT NULL, nom VARCHAR(255) NOT NULL, description TINYTEXT DEFAULT NULL, prix DOUBLE PRECISION DEFAULT NULL, date_achat DATE DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, date_sortie DATE DEFAULT NULL, is_buy TINYINT(1) NOT NULL, INDEX IDX_232B318CDB3AEE9F (id_editeur), INDEX IDX_232B318C6DD572C8 (id_genre), INDEX IDX_232B318C69893C5E (id_platform), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genre (id INT AUTO_INCREMENT NOT NULL, create_date DATE NOT NULL, update_date DATE DEFAULT NULL, is_active TINYINT(1) NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE impression (id INT AUTO_INCREMENT NOT NULL, id_game INT DEFAULT NULL, create_date DATE NOT NULL, update_date DATE DEFAULT NULL, is_active TINYINT(1) NOT NULL, description TINYTEXT NOT NULL, how_end INT NOT NULL, taux_de_completion DOUBLE PRECISION NOT NULL, date_impression DATE NOT NULL, INDEX IDX_245BB1B1A80B2D8E (id_game), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE platform (id INT AUTO_INCREMENT NOT NULL, create_date DATE NOT NULL, update_date DATE DEFAULT NULL, is_active TINYINT(1) NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, create_date DATE NOT NULL, update_date DATE DEFAULT NULL, is_active TINYINT(1) NOT NULL, email VARCHAR(180) NOT NULL, name VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video (id INT AUTO_INCREMENT NOT NULL, game_id INT DEFAULT NULL, create_date DATE NOT NULL, update_date DATE DEFAULT NULL, is_active TINYINT(1) NOT NULL, video VARCHAR(255) NOT NULL, INDEX IDX_7CC7DA2CE48FD905 (game_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318CDB3AEE9F FOREIGN KEY (id_editeur) REFERENCES editeur (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C6DD572C8 FOREIGN KEY (id_genre) REFERENCES genre (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C69893C5E FOREIGN KEY (id_platform) REFERENCES platform (id)');
        $this->addSql('ALTER TABLE impression ADD CONSTRAINT FK_245BB1B1A80B2D8E FOREIGN KEY (id_game) REFERENCES game (id)');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2CE48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318CDB3AEE9F');
        $this->addSql('ALTER TABLE impression DROP FOREIGN KEY FK_245BB1B1A80B2D8E');
        $this->addSql('ALTER TABLE video DROP FOREIGN KEY FK_7CC7DA2CE48FD905');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C6DD572C8');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C69893C5E');
        $this->addSql('DROP TABLE editeur');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP TABLE impression');
        $this->addSql('DROP TABLE platform');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE video');
    }
}
