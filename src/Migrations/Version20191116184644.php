<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191116184644 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ans DROP FOREIGN KEY FK_84261EAAD5760B6B');
        $this->addSql('CREATE TABLE survey_questions (id INT AUTO_INCREMENT NOT NULL, survey_id INT NOT NULL, question VARCHAR(255) NOT NULL, INDEX IDX_2F8A16F8B3FE509D (survey_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE survey (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, questions_per_page SMALLINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE survey_questions ADD CONSTRAINT FK_2F8A16F8B3FE509D FOREIGN KEY (survey_id) REFERENCES survey (id)');
        $this->addSql('DROP TABLE ans');
        $this->addSql('DROP TABLE que');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE survey_questions DROP FOREIGN KEY FK_2F8A16F8B3FE509D');
        $this->addSql('CREATE TABLE ans (id INT AUTO_INCREMENT NOT NULL, que_id INT NOT NULL, ans VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, poll_count INT NOT NULL, INDEX IDX_84261EAAD5760B6B (que_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE que (id INT AUTO_INCREMENT NOT NULL, que VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE ans ADD CONSTRAINT FK_84261EAAD5760B6B FOREIGN KEY (que_id) REFERENCES que (id)');
        $this->addSql('DROP TABLE survey_questions');
        $this->addSql('DROP TABLE survey');
    }
}
