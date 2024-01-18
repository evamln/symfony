<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231221082503 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE personnages (id INT AUTO_INCREMENT NOT NULL, stand_id INT DEFAULT NULL, statut_id INT NOT NULL, name VARCHAR(100) NOT NULL, image VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_286738A69734D487 (stand_id), INDEX IDX_286738A6F6203804 (statut_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personnages_saisons (personnages_id INT NOT NULL, saisons_id INT NOT NULL, INDEX IDX_78B386AF7FFDACCA (personnages_id), INDEX IDX_78B386AF98E2D5DF (saisons_id), PRIMARY KEY(personnages_id, saisons_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE poses (id INT AUTO_INCREMENT NOT NULL, personnages_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_DB8499EA7FFDACCA (personnages_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE saisons (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stand (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, pouvoirs LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', points_fort LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statut (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE personnages ADD CONSTRAINT FK_286738A69734D487 FOREIGN KEY (stand_id) REFERENCES stand (id)');
        $this->addSql('ALTER TABLE personnages ADD CONSTRAINT FK_286738A6F6203804 FOREIGN KEY (statut_id) REFERENCES statut (id)');
        $this->addSql('ALTER TABLE personnages_saisons ADD CONSTRAINT FK_78B386AF7FFDACCA FOREIGN KEY (personnages_id) REFERENCES personnages (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personnages_saisons ADD CONSTRAINT FK_78B386AF98E2D5DF FOREIGN KEY (saisons_id) REFERENCES saisons (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE poses ADD CONSTRAINT FK_DB8499EA7FFDACCA FOREIGN KEY (personnages_id) REFERENCES personnages (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personnages DROP FOREIGN KEY FK_286738A69734D487');
        $this->addSql('ALTER TABLE personnages DROP FOREIGN KEY FK_286738A6F6203804');
        $this->addSql('ALTER TABLE personnages_saisons DROP FOREIGN KEY FK_78B386AF7FFDACCA');
        $this->addSql('ALTER TABLE personnages_saisons DROP FOREIGN KEY FK_78B386AF98E2D5DF');
        $this->addSql('ALTER TABLE poses DROP FOREIGN KEY FK_DB8499EA7FFDACCA');
        $this->addSql('DROP TABLE personnages');
        $this->addSql('DROP TABLE personnages_saisons');
        $this->addSql('DROP TABLE poses');
        $this->addSql('DROP TABLE saisons');
        $this->addSql('DROP TABLE stand');
        $this->addSql('DROP TABLE statut');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
