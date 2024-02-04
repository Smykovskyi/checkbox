<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240204142601 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE books ADD image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE books ADD CONSTRAINT FK_4A1B2A923DA5256D FOREIGN KEY (image_id) REFERENCES images (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4A1B2A923DA5256D ON books (image_id)');
        $this->addSql('ALTER TABLE images DROP CONSTRAINT fk_e01fbe6a16a2b381');
        $this->addSql('DROP INDEX uniq_e01fbe6a16a2b381');
        $this->addSql('ALTER TABLE images DROP book_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE images ADD book_id INT NOT NULL');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT fk_e01fbe6a16a2b381 FOREIGN KEY (book_id) REFERENCES books (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX uniq_e01fbe6a16a2b381 ON images (book_id)');
        $this->addSql('ALTER TABLE books DROP CONSTRAINT FK_4A1B2A923DA5256D');
        $this->addSql('DROP INDEX UNIQ_4A1B2A923DA5256D');
        $this->addSql('ALTER TABLE books DROP image_id');
    }
}
