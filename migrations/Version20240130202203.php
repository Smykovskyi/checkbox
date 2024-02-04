<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240130202203 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE authors ADD book_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE authors ADD CONSTRAINT FK_8E0C2A5116A2B381 FOREIGN KEY (book_id) REFERENCES books (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_8E0C2A5116A2B381 ON authors (book_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE authors DROP CONSTRAINT FK_8E0C2A5116A2B381');
        $this->addSql('DROP INDEX IDX_8E0C2A5116A2B381');
        $this->addSql('ALTER TABLE authors DROP book_id');
    }
}
