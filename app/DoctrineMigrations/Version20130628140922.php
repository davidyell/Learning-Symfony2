<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20130628140922 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE answers CHANGE created created DATETIME DEFAULT NULL, CHANGE modified modified DATETIME DEFAULT NULL");
        $this->addSql("ALTER TABLE questions CHANGE created created DATETIME DEFAULT NULL, CHANGE modified modified DATETIME DEFAULT NULL");
        $this->addSql("ALTER TABLE users CHANGE created created DATETIME DEFAULT NULL, CHANGE modified modified DATETIME DEFAULT NULL");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE answers CHANGE created created DATETIME NOT NULL, CHANGE modified modified DATETIME NOT NULL");
        $this->addSql("ALTER TABLE questions CHANGE created created DATETIME NOT NULL, CHANGE modified modified DATETIME NOT NULL");
        $this->addSql("ALTER TABLE users CHANGE created created DATETIME NOT NULL, CHANGE modified modified DATETIME NOT NULL");
    }
}
