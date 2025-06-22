<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250609173526 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TEMPORARY TABLE __temp__user AS SELECT id, email, login, first_name, last_name, second_name, created_at, roles, updated_at, is_active, age, password, phone_number FROM user
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE user
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(255) DEFAULT NULL, login VARCHAR(100) DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, second_name VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL --(DC2Type:datetime_immutable)
            , roles CLOB NOT NULL --(DC2Type:array)
            , updated_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
            , is_active BOOLEAN DEFAULT 1 NOT NULL, age INTEGER NOT NULL, password VARCHAR(255) NOT NULL, phone_number VARCHAR(255) NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            INSERT INTO user (id, email, login, first_name, last_name, second_name, created_at, roles, updated_at, is_active, age, password, phone_number) SELECT id, email, login, first_name, last_name, second_name, created_at, roles, updated_at, is_active, age, password, phone_number FROM __temp__user
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE __temp__user
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TEMPORARY TABLE __temp__user AS SELECT id, email, login, first_name, last_name, second_name, created_at, roles, updated_at, is_active, age, password, phone_number FROM "user"
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE "user"
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE "user" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(255) NOT NULL, login VARCHAR(100) DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, second_name VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL --(DC2Type:datetime_immutable)
            , roles CLOB NOT NULL --(DC2Type:array)
            , updated_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
            , is_active BOOLEAN DEFAULT 1 NOT NULL, age INTEGER NOT NULL, password VARCHAR(255) NOT NULL, phone_number VARCHAR(255) NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            INSERT INTO "user" (id, email, login, first_name, last_name, second_name, created_at, roles, updated_at, is_active, age, password, phone_number) SELECT id, email, login, first_name, last_name, second_name, created_at, roles, updated_at, is_active, age, password, phone_number FROM __temp__user
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE __temp__user
        SQL);
    }
}
