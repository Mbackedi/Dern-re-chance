<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190711123303 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE employer (id INT AUTO_INCREMENT NOT NULL, service_id INT DEFAULT NULL, matricule VARCHAR(255) NOT NULL, nom_complet VARCHAR(255) NOT NULL, date_naiss DATETIME NOT NULL, salaire INT NOT NULL, INDEX IDX_DE4CF066ED5CA9E6 (service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE employer ADD CONSTRAINT FK_DE4CF066ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('DROP TABLE employe');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE employe (id INT AUTO_INCREMENT NOT NULL, matricule VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, nom VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, date_naiss DATETIME NOT NULL, salaire INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE employer');
    }
}
