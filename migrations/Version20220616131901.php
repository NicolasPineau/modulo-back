<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220616131901 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE event_invitation (id INT AUTO_INCREMENT NOT NULL, event_id INT DEFAULT NULL, INDEX IDX_A9F3B88D71F7E88B (event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE event_invitation ADD CONSTRAINT FK_A9F3B88D71F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE user ADD event_invitation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6498704CA5C FOREIGN KEY (event_invitation_id) REFERENCES event_invitation (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6498704CA5C ON user (event_invitation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D6498704CA5C');
        $this->addSql('DROP TABLE event_invitation');
        $this->addSql('DROP INDEX IDX_8D93D6498704CA5C ON `user`');
        $this->addSql('ALTER TABLE `user` DROP event_invitation_id');
    }
}
