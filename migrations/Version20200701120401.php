<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200701120401 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C4296D31F');
        $this->addSql('DROP INDEX IDX_232B318C4296D31F ON game');
        $this->addSql('ALTER TABLE game CHANGE genre_id id_genre INT NOT NULL');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C6DD572C8 FOREIGN KEY (id_genre) REFERENCES genre (id)');
        $this->addSql('CREATE INDEX IDX_232B318C6DD572C8 ON game (id_genre)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C6DD572C8');
        $this->addSql('DROP INDEX IDX_232B318C6DD572C8 ON game');
        $this->addSql('ALTER TABLE game CHANGE id_genre genre_id INT NOT NULL');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C4296D31F FOREIGN KEY (genre_id) REFERENCES genre (id)');
        $this->addSql('CREATE INDEX IDX_232B318C4296D31F ON game (genre_id)');
    }
}
