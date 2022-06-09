<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220522130055 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE age_section (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(50) NOT NULL, code VARCHAR(10) NOT NULL, color VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_E30B670D77153098 (code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', age_section_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(100) NOT NULL, code VARCHAR(10) NOT NULL, feminine_name VARCHAR(100) DEFAULT NULL, icon VARCHAR(50) DEFAULT NULL, INDEX IDX_57698A6AD3F77268 (age_section_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE scope (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', user_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', structure_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', role_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', active TINYINT(1) NOT NULL, INDEX IDX_AF55D3A76ED395 (user_id), INDEX IDX_AF55D32534008B (structure_id), INDEX IDX_AF55D3D60322AC (role_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE structure (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', parent_structure_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(100) NOT NULL, code VARCHAR(10) NOT NULL, INDEX IDX_6F0137EA755A5DA5 (parent_structure_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_event (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', email VARCHAR(200) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, genre VARCHAR(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE role ADD CONSTRAINT FK_57698A6AD3F77268 FOREIGN KEY (age_section_id) REFERENCES age_section (id)');
        $this->addSql('ALTER TABLE scope ADD CONSTRAINT FK_AF55D3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE scope ADD CONSTRAINT FK_AF55D32534008B FOREIGN KEY (structure_id) REFERENCES structure (id)');
        $this->addSql('ALTER TABLE scope ADD CONSTRAINT FK_AF55D3D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
        $this->addSql('ALTER TABLE structure ADD CONSTRAINT FK_6F0137EA755A5DA5 FOREIGN KEY (parent_structure_id) REFERENCES structure (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE role DROP FOREIGN KEY FK_57698A6AD3F77268');
        $this->addSql('ALTER TABLE scope DROP FOREIGN KEY FK_AF55D3D60322AC');
        $this->addSql('ALTER TABLE scope DROP FOREIGN KEY FK_AF55D32534008B');
        $this->addSql('ALTER TABLE structure DROP FOREIGN KEY FK_6F0137EA755A5DA5');
        $this->addSql('ALTER TABLE scope DROP FOREIGN KEY FK_AF55D3A76ED395');
        $this->addSql('DROP TABLE age_section');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE scope');
        $this->addSql('DROP TABLE structure');
        $this->addSql('DROP TABLE type_event');
        $this->addSql('DROP TABLE user');
    }
}
