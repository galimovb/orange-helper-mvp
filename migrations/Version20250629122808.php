<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250629122808 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE consulation_request (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, consultant_id INTEGER DEFAULT NULL, requested_date_time DATETIME DEFAULT NULL, children_full_name VARCHAR(255) DEFAULT NULL, CONSTRAINT FK_15FACE3FA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_15FACE3F44F779A2 FOREIGN KEY (consultant_id) REFERENCES "employees" (id) NOT DEFERRABLE INITIALLY IMMEDIATE)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_15FACE3FA76ED395 ON consulation_request (user_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_15FACE3F44F779A2 ON consulation_request (consultant_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            DROP TABLE consulation_request
        SQL);
    }
}
