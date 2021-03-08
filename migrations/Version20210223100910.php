<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210223100910 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'création de la table dépôts avec relation 1user plusieurs dépôts possibles permet à admin déposer des avis utilisateurs non membres demandeurs';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE depots (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, depotit VARCHAR(80) NOT NULL, depoavis LONGTEXT DEFAULT NULL, deporef VARCHAR(50) DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, image_name VARCHAR(50) DEFAULT NULL, depocorres VARCHAR(50) DEFAULT NULL, INDEX IDX_D99EA427A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE depots ADD CONSTRAINT FK_D99EA427A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE docs CHANGE updated_at updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE depots');
        $this->addSql('ALTER TABLE docs CHANGE updated_at updated_at DATETIME DEFAULT NULL');
    }
}
