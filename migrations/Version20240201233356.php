<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240201233356 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE books_authors DROP CONSTRAINT fk_877eacc28e0c2a51');
        $this->addSql('DROP INDEX idx_877eacc28e0c2a51');
        $this->addSql('ALTER TABLE books_authors DROP CONSTRAINT books_authors_pkey');
        $this->addSql('ALTER TABLE books_authors RENAME COLUMN authors TO book_id');
        $this->addSql('ALTER TABLE books_authors ADD CONSTRAINT FK_877EACC216A2B381 FOREIGN KEY (book_id) REFERENCES books (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_877EACC216A2B381 ON books_authors (book_id)');
        $this->addSql('ALTER TABLE books_authors ADD PRIMARY KEY (book_id, author_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE books_authors DROP CONSTRAINT FK_877EACC216A2B381');
        $this->addSql('DROP INDEX IDX_877EACC216A2B381');
        $this->addSql('DROP INDEX books_authors_pkey');
        $this->addSql('ALTER TABLE books_authors RENAME COLUMN book_id TO authors');
        $this->addSql('ALTER TABLE books_authors ADD CONSTRAINT fk_877eacc28e0c2a51 FOREIGN KEY (authors) REFERENCES books (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_877eacc28e0c2a51 ON books_authors (authors)');
        $this->addSql('ALTER TABLE books_authors ADD PRIMARY KEY (authors, author_id)');
    }
}
