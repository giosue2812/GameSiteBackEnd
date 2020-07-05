<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200701120712 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game ADD id_envie INT DEFAULT NULL');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C7B179FFB FOREIGN KEY (id_envie) REFERENCES liste_envie (id)');
        $this->addSql('CREATE INDEX IDX_232B318C7B179FFB ON game (id_envie)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C7B179FFB');
        $this->addSql('DROP INDEX IDX_232B318C7B179FFB ON game');
        $this->addSql('ALTER TABLE game DROP id_envie');
    }
}
