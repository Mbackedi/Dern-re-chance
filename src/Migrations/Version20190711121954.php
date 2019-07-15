<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190711121954 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE employe (id INT AUTO_INCREMENT NOT NULL, matricule VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, date_naiss DATETIME NOT NULL, salaire INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, employe_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, INDEX IDX_E19D9AD21B65292 (employe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD21B65292 FOREIGN KEY (employe_id) REFERENCES employe (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE service DROP FOREIGN KEY FK_E19D9AD21B65292');
        $this->addSql('DROP TABLE employe');
        $this->addSql('DROP TABLE service');
    }
}
