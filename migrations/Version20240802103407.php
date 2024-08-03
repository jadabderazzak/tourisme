<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240802103407 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE listing_tags (id INT AUTO_INCREMENT NOT NULL, listing_id INT NOT NULL, tags_id INT NOT NULL, INDEX IDX_384243F3D4619D1A (listing_id), INDEX IDX_384243F38D7B4FB4 (tags_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE listing_tags ADD CONSTRAINT FK_384243F3D4619D1A FOREIGN KEY (listing_id) REFERENCES listing (id)');
        $this->addSql('ALTER TABLE listing_tags ADD CONSTRAINT FK_384243F38D7B4FB4 FOREIGN KEY (tags_id) REFERENCES tags (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE listing_tags DROP FOREIGN KEY FK_384243F3D4619D1A');
        $this->addSql('ALTER TABLE listing_tags DROP FOREIGN KEY FK_384243F38D7B4FB4');
        $this->addSql('DROP TABLE listing_tags');
    }
}
