<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240201233049 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE books_authors (authors INT NOT NULL, author_id INT NOT NULL, PRIMARY KEY(authors, author_id))');
        $this->addSql('CREATE INDEX IDX_877EACC28E0C2A51 ON books_authors (authors)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_877EACC2F675F31B ON books_authors (author_id)');
        $this->addSql('ALTER TABLE books_authors ADD CONSTRAINT FK_877EACC28E0C2A51 FOREIGN KEY (authors) REFERENCES books (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE books_authors ADD CONSTRAINT FK_877EACC2F675F31B FOREIGN KEY (author_id) REFERENCES authors (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE authors DROP CONSTRAINT fk_8e0c2a5116a2b381');
        $this->addSql('DROP INDEX idx_8e0c2a5116a2b381');
        $this->addSql('ALTER TABLE authors DROP book_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE books_authors DROP CONSTRAINT FK_877EACC28E0C2A51');
        $this->addSql('ALTER TABLE books_authors DROP CONSTRAINT FK_877EACC2F675F31B');
        $this->addSql('DROP TABLE books_authors');
        $this->addSql('ALTER TABLE authors ADD book_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE authors ADD CONSTRAINT fk_8e0c2a5116a2b381 FOREIGN KEY (book_id) REFERENCES books (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_8e0c2a5116a2b381 ON authors (book_id)');
    }
}
