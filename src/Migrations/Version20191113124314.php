<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191113124314 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ans ADD que_id INT NOT NULL');
        $this->addSql('ALTER TABLE ans ADD CONSTRAINT FK_84261EAAD5760B6B FOREIGN KEY (que_id) REFERENCES que (id)');
        $this->addSql('CREATE INDEX IDX_84261EAAD5760B6B ON ans (que_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ans DROP FOREIGN KEY FK_84261EAAD5760B6B');
        $this->addSql('DROP INDEX IDX_84261EAAD5760B6B ON ans');
        $this->addSql('ALTER TABLE ans DROP que_id');
    }
}
