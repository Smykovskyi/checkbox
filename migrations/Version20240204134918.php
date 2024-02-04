<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240204134918 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE images (id SERIAL NOT NULL, book_id INT NOT NULL, extension VARCHAR(50) NOT NULL, size INT NOT NULL, name VARCHAR(255) NOT NULL, path VARCHAR(500) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E01FBE6A16A2B381 ON images (book_id)');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6A16A2B381 FOREIGN KEY (book_id) REFERENCES books (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE images DROP CONSTRAINT FK_E01FBE6A16A2B381');
        $this->addSql('DROP TABLE images');
    }
}
