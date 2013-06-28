<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20130628133344 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE answers CHANGE upvotes upvotes INT DEFAULT NULL, CHANGE downvotes downvotes INT DEFAULT NULL");
        $this->addSql("ALTER TABLE questions CHANGE upvotes upvotes INT DEFAULT NULL, CHANGE downvotes downvotes INT DEFAULT NULL");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE answers CHANGE upvotes upvotes INT NOT NULL, CHANGE downvotes downvotes INT NOT NULL");
        $this->addSql("ALTER TABLE questions CHANGE upvotes upvotes INT NOT NULL, CHANGE downvotes downvotes INT NOT NULL");
    }
}
