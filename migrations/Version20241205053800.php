<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241205053800 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gloss_treasure ADD owner_id INT NOT NULL');
        $this->addSql('ALTER TABLE gloss_treasure ADD CONSTRAINT FK_8596FD2A7E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_8596FD2A7E3C61F9 ON gloss_treasure (owner_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gloss_treasure DROP FOREIGN KEY FK_8596FD2A7E3C61F9');
        $this->addSql('DROP INDEX IDX_8596FD2A7E3C61F9 ON gloss_treasure');
        $this->addSql('ALTER TABLE gloss_treasure DROP owner_id');
    }
}
