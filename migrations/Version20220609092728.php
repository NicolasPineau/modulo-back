<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220609092728 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE event_structure (event_id INT NOT NULL, structure_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', INDEX IDX_E99409D771F7E88B (event_id), INDEX IDX_E99409D72534008B (structure_id), PRIMARY KEY(event_id, structure_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_role (event_id INT NOT NULL, role_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', INDEX IDX_48A2C6C171F7E88B (event_id), INDEX IDX_48A2C6C1D60322AC (role_id), PRIMARY KEY(event_id, role_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_user (event_id INT NOT NULL, user_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', INDEX IDX_92589AE271F7E88B (event_id), INDEX IDX_92589AE2A76ED395 (user_id), PRIMARY KEY(event_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE event_structure ADD CONSTRAINT FK_E99409D771F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_structure ADD CONSTRAINT FK_E99409D72534008B FOREIGN KEY (structure_id) REFERENCES structure (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_role ADD CONSTRAINT FK_48A2C6C171F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_role ADD CONSTRAINT FK_48A2C6C1D60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_user ADD CONSTRAINT FK_92589AE271F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_user ADD CONSTRAINT FK_92589AE2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event_user DROP FOREIGN KEY FK_92589AE2A76ED395');
        $this->addSql('ALTER TABLE scope DROP FOREIGN KEY FK_AF55D3A76ED395');
        $this->addSql('DROP TABLE event_structure');
        $this->addSql('DROP TABLE event_role');
        $this->addSql('DROP TABLE event_user');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE event CHANGE type_event_id type_event_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE role DROP FOREIGN KEY FK_57698A6AD3F77268');
        $this->addSql('ALTER TABLE scope DROP FOREIGN KEY FK_AF55D32534008B');
        $this->addSql('ALTER TABLE scope DROP FOREIGN KEY FK_AF55D3D60322AC');
        $this->addSql('ALTER TABLE structure DROP FOREIGN KEY FK_6F0137EA755A5DA5');
    }
}
