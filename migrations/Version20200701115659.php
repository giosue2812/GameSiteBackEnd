<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200701115659 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C3375BD21');
        $this->addSql('DROP INDEX IDX_232B318C3375BD21 ON game');
        $this->addSql('ALTER TABLE game CHANGE editeur_id id_editeur INT NOT NULL');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318CDB3AEE9F FOREIGN KEY (id_editeur) REFERENCES editeur (id)');
        $this->addSql('CREATE INDEX IDX_232B318CDB3AEE9F ON game (id_editeur)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318CDB3AEE9F');
        $this->addSql('DROP INDEX IDX_232B318CDB3AEE9F ON game');
        $this->addSql('ALTER TABLE game CHANGE id_editeur editeur_id INT NOT NULL');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C3375BD21 FOREIGN KEY (editeur_id) REFERENCES editeur (id)');
        $this->addSql('CREATE INDEX IDX_232B318C3375BD21 ON game (editeur_id)');
    }
}
