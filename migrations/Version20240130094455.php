<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240130094455 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE authors (id SERIAL NOT NULL, books_id INT NOT NULL, surname VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, patronymic VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8E0C2A517DD8AC20 ON authors (books_id)');
        $this->addSql('CREATE TABLE books (id SERIAL NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(600) DEFAULT NULL, publicated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE authors ADD CONSTRAINT FK_8E0C2A517DD8AC20 FOREIGN KEY (books_id) REFERENCES books (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE authors DROP CONSTRAINT FK_8E0C2A517DD8AC20');
        $this->addSql('DROP TABLE authors');
        $this->addSql('DROP TABLE books');
    }
}
