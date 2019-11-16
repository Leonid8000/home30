<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191110150933 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE poll (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, user_question1 TINYTEXT NOT NULL, user_answer1 TINYTEXT NOT NULL, user_question2 TINYTEXT NOT NULL, user_answer2 TINYTEXT NOT NULL, user_question3 TINYTEXT NOT NULL, user_answer3 TINYTEXT NOT NULL, user_question4 TINYTEXT NOT NULL, user_answer4 TINYTEXT NOT NULL, user_question5 TINYTEXT NOT NULL, user_answer5 TINYTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE poll');
    }
}
