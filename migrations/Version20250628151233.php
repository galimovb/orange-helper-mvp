<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250628151233 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE "employees" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(255) DEFAULT NULL, login VARCHAR(100) DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, second_name VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL --(DC2Type:datetime_immutable)
            , roles CLOB NOT NULL --(DC2Type:array)
            , updated_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
            , is_active BOOLEAN DEFAULT 1 NOT NULL, age INTEGER NOT NULL, password VARCHAR(255) NOT NULL, phone_number VARCHAR(255) NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE newsletter_subscription (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, is_confirmed BOOLEAN NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
            )
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            DROP TABLE "employees"
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE newsletter_subscription
        SQL);
    }
}
