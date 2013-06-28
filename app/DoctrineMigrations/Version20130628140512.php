<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20130628140512 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE answers ADD created DATETIME NOT NULL, ADD modified DATETIME NOT NULL");
        $this->addSql("ALTER TABLE questions ADD created DATETIME NOT NULL, ADD modified DATETIME NOT NULL");
        $this->addSql("ALTER TABLE users ADD created DATETIME NOT NULL, ADD modified DATETIME NOT NULL");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE answers DROP created, DROP modified");
        $this->addSql("ALTER TABLE questions DROP created, DROP modified");
        $this->addSql("ALTER TABLE users DROP created, DROP modified");
    }
}
