<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240710083744 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE listing (id INT AUTO_INCREMENT NOT NULL, ville_id INT NOT NULL, categorie_id INT NOT NULL, pension_id INT DEFAULT NULL, name VARCHAR(400) NOT NULL, adresse LONGTEXT DEFAULT NULL, nb_couverts SMALLINT NOT NULL, nb_chambre SMALLINT NOT NULL, nb_lit SMALLINT NOT NULL, siteweb VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) DEFAULT NULL, facebook VARCHAR(255) DEFAULT NULL, instagram VARCHAR(255) DEFAULT NULL, tiktok VARCHAR(255) DEFAULT NULL, youtube VARCHAR(255) DEFAULT NULL, twitter VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, latitude VARCHAR(255) DEFAULT NULL, longitude VARCHAR(255) DEFAULT NULL, prix_start DOUBLE PRECISION DEFAULT NULL, prix_end DOUBLE PRECISION DEFAULT NULL, INDEX IDX_CB0048D4A73F0036 (ville_id), INDEX IDX_CB0048D4BCF5E72D (categorie_id), INDEX IDX_CB0048D46DB67326 (pension_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE listing ADD CONSTRAINT FK_CB0048D4A73F0036 FOREIGN KEY (ville_id) REFERENCES localite (id)');
        $this->addSql('ALTER TABLE listing ADD CONSTRAINT FK_CB0048D4BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE listing ADD CONSTRAINT FK_CB0048D46DB67326 FOREIGN KEY (pension_id) REFERENCES type_pension (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE listing DROP FOREIGN KEY FK_CB0048D4A73F0036');
        $this->addSql('ALTER TABLE listing DROP FOREIGN KEY FK_CB0048D4BCF5E72D');
        $this->addSql('ALTER TABLE listing DROP FOREIGN KEY FK_CB0048D46DB67326');
        $this->addSql('DROP TABLE listing');
    }
}
