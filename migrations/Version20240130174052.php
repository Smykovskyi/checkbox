<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240130174052 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE authors DROP CONSTRAINT fk_8e0c2a517dd8ac20');
        $this->addSql('DROP INDEX idx_8e0c2a517dd8ac20');
        $this->addSql('ALTER TABLE authors DROP books_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE authors ADD books_id INT NOT NULL');
        $this->addSql('ALTER TABLE authors ADD CONSTRAINT fk_8e0c2a517dd8ac20 FOREIGN KEY (books_id) REFERENCES books (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_8e0c2a517dd8ac20 ON authors (books_id)');
    }
}
