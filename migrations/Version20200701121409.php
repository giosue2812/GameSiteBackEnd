<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200701121409 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318CA3BA46B6');
        $this->addSql('DROP INDEX IDX_232B318CA3BA46B6 ON game');
        $this->addSql('ALTER TABLE game DROP impression_id');
        $this->addSql('ALTER TABLE impression ADD id_game INT DEFAULT NULL');
        $this->addSql('ALTER TABLE impression ADD CONSTRAINT FK_245BB1B1A80B2D8E FOREIGN KEY (id_game) REFERENCES game (id)');
        $this->addSql('CREATE INDEX IDX_245BB1B1A80B2D8E ON impression (id_game)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game ADD impression_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318CA3BA46B6 FOREIGN KEY (impression_id) REFERENCES impression (id)');
        $this->addSql('CREATE INDEX IDX_232B318CA3BA46B6 ON game (impression_id)');
        $this->addSql('ALTER TABLE impression DROP FOREIGN KEY FK_245BB1B1A80B2D8E');
        $this->addSql('DROP INDEX IDX_245BB1B1A80B2D8E ON impression');
        $this->addSql('ALTER TABLE impression DROP id_game');
    }
}
