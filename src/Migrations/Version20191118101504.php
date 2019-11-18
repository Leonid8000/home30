<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191118101504 extends AbstractMigration
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
        $this->addSql('DROP TABLE ans');
        $this->addSql('DROP TABLE que');
        $this->addSql('ALTER TABLE poll ADD user_answer TINYTEXT NOT NULL, DROP user_question1, DROP user_answer1, DROP user_question2, DROP user_answer2, DROP user_question3, DROP user_answer3, DROP user_question4, DROP user_answer4, DROP user_question5, DROP user_answer5');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ans (id INT AUTO_INCREMENT NOT NULL, que_id INT NOT NULL, ans VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_84261EAAD5760B6B (que_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE que (id INT AUTO_INCREMENT NOT NULL, que VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE ans ADD CONSTRAINT FK_84261EAAD5760B6B FOREIGN KEY (que_id) REFERENCES que (id)');
        $this->addSql('ALTER TABLE poll ADD user_answer1 TINYTEXT NOT NULL COLLATE utf8mb4_unicode_ci, ADD user_question2 TINYTEXT NOT NULL COLLATE utf8mb4_unicode_ci, ADD user_answer2 TINYTEXT NOT NULL COLLATE utf8mb4_unicode_ci, ADD user_question3 TINYTEXT NOT NULL COLLATE utf8mb4_unicode_ci, ADD user_answer3 TINYTEXT NOT NULL COLLATE utf8mb4_unicode_ci, ADD user_question4 TINYTEXT NOT NULL COLLATE utf8mb4_unicode_ci, ADD user_answer4 TINYTEXT NOT NULL COLLATE utf8mb4_unicode_ci, ADD user_question5 TINYTEXT NOT NULL COLLATE utf8mb4_unicode_ci, ADD user_answer5 TINYTEXT NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE user_answer user_question1 TINYTEXT NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
