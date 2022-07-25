<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220725095501 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE practice ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE practice ADD CONSTRAINT FK_7FEC344EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_7FEC344EA76ED395 ON practice (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE practice DROP FOREIGN KEY FK_7FEC344EA76ED395');
        $this->addSql('DROP INDEX IDX_7FEC344EA76ED395 ON practice');
        $this->addSql('ALTER TABLE practice DROP user_id');
    }
}
