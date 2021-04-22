<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210416213735 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__category AS SELECT id, name, slug FROM category');
        $this->addSql('DROP TABLE category');
        $this->addSql('CREATE TABLE category (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, owner_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, slug VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_64C19C17E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO category (id, name, slug) SELECT id, name, slug FROM __temp__category');
        $this->addSql('DROP TABLE __temp__category');
        $this->addSql('CREATE INDEX IDX_64C19C17E3C61F9 ON category (owner_id)');
        $this->addSql('DROP INDEX IDX_D34A04AD12469DE2');
        $this->addSql('CREATE TEMPORARY TABLE __temp__product AS SELECT id, category_id, name, price, slug, main_picture, short_description FROM product');
        $this->addSql('DROP TABLE product');
        $this->addSql('CREATE TABLE product (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, category_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, price INTEGER NOT NULL, slug VARCHAR(255) NOT NULL COLLATE BINARY, main_picture VARCHAR(255) NOT NULL COLLATE BINARY, short_description CLOB NOT NULL COLLATE BINARY, CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO product (id, category_id, name, price, slug, main_picture, short_description) SELECT id, category_id, name, price, slug, main_picture, short_description FROM __temp__product');
        $this->addSql('DROP TABLE __temp__product');
        $this->addSql('CREATE INDEX IDX_D34A04AD12469DE2 ON product (category_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_64C19C17E3C61F9');
        $this->addSql('CREATE TEMPORARY TABLE __temp__category AS SELECT id, name, slug FROM category');
        $this->addSql('DROP TABLE category');
        $this->addSql('CREATE TABLE category (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO category (id, name, slug) SELECT id, name, slug FROM __temp__category');
        $this->addSql('DROP TABLE __temp__category');
        $this->addSql('DROP INDEX IDX_D34A04AD12469DE2');
        $this->addSql('CREATE TEMPORARY TABLE __temp__product AS SELECT id, category_id, name, price, slug, main_picture, short_description FROM product');
        $this->addSql('DROP TABLE product');
        $this->addSql('CREATE TABLE product (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, category_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, price INTEGER NOT NULL, slug VARCHAR(255) NOT NULL, main_picture VARCHAR(255) NOT NULL, short_description CLOB NOT NULL)');
        $this->addSql('INSERT INTO product (id, category_id, name, price, slug, main_picture, short_description) SELECT id, category_id, name, price, slug, main_picture, short_description FROM __temp__product');
        $this->addSql('DROP TABLE __temp__product');
        $this->addSql('CREATE INDEX IDX_D34A04AD12469DE2 ON product (category_id)');
    }
}
