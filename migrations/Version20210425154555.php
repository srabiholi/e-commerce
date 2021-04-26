<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210425154555 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE purchase_item (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, product_id INTEGER DEFAULT NULL, purchase_id INTEGER NOT NULL, product_name VARCHAR(255) NOT NULL, product_price INTEGER NOT NULL, quantity INTEGER NOT NULL, total INTEGER NOT NULL)');
        $this->addSql('CREATE INDEX IDX_6FA8ED7D4584665A ON purchase_item (product_id)');
        $this->addSql('CREATE INDEX IDX_6FA8ED7D558FBEB9 ON purchase_item (purchase_id)');
        $this->addSql('DROP INDEX IDX_64C19C17E3C61F9');
        $this->addSql('CREATE TEMPORARY TABLE __temp__category AS SELECT id, owner_id, name, slug FROM category');
        $this->addSql('DROP TABLE category');
        $this->addSql('CREATE TABLE category (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, owner_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, slug VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_64C19C17E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO category (id, owner_id, name, slug) SELECT id, owner_id, name, slug FROM __temp__category');
        $this->addSql('DROP TABLE __temp__category');
        $this->addSql('CREATE INDEX IDX_64C19C17E3C61F9 ON category (owner_id)');
        $this->addSql('DROP INDEX IDX_D34A04AD12469DE2');
        $this->addSql('CREATE TEMPORARY TABLE __temp__product AS SELECT id, category_id, name, price, slug, main_picture, short_description FROM product');
        $this->addSql('DROP TABLE product');
        $this->addSql('CREATE TABLE product (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, category_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, price INTEGER NOT NULL, slug VARCHAR(255) NOT NULL COLLATE BINARY, main_picture VARCHAR(255) NOT NULL COLLATE BINARY, short_description CLOB NOT NULL COLLATE BINARY, CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO product (id, category_id, name, price, slug, main_picture, short_description) SELECT id, category_id, name, price, slug, main_picture, short_description FROM __temp__product');
        $this->addSql('DROP TABLE __temp__product');
        $this->addSql('CREATE INDEX IDX_D34A04AD12469DE2 ON product (category_id)');
        $this->addSql('DROP INDEX IDX_6117D13BA76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__purchase AS SELECT id, user_id, full_name, address, postal_code, city, total, status, purchased_at FROM purchase');
        $this->addSql('DROP TABLE purchase');
        $this->addSql('CREATE TABLE purchase (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER DEFAULT NULL, full_name VARCHAR(255) NOT NULL COLLATE BINARY, address VARCHAR(255) NOT NULL COLLATE BINARY, postal_code VARCHAR(255) NOT NULL COLLATE BINARY, city VARCHAR(255) NOT NULL COLLATE BINARY, total INTEGER NOT NULL, status VARCHAR(255) NOT NULL COLLATE BINARY, purchased_at DATETIME NOT NULL, CONSTRAINT FK_6117D13BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO purchase (id, user_id, full_name, address, postal_code, city, total, status, purchased_at) SELECT id, user_id, full_name, address, postal_code, city, total, status, purchased_at FROM __temp__purchase');
        $this->addSql('DROP TABLE __temp__purchase');
        $this->addSql('CREATE INDEX IDX_6117D13BA76ED395 ON purchase (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE purchase_item');
        $this->addSql('DROP INDEX IDX_64C19C17E3C61F9');
        $this->addSql('CREATE TEMPORARY TABLE __temp__category AS SELECT id, owner_id, name, slug FROM category');
        $this->addSql('DROP TABLE category');
        $this->addSql('CREATE TABLE category (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, owner_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO category (id, owner_id, name, slug) SELECT id, owner_id, name, slug FROM __temp__category');
        $this->addSql('DROP TABLE __temp__category');
        $this->addSql('CREATE INDEX IDX_64C19C17E3C61F9 ON category (owner_id)');
        $this->addSql('DROP INDEX IDX_D34A04AD12469DE2');
        $this->addSql('CREATE TEMPORARY TABLE __temp__product AS SELECT id, category_id, name, price, slug, main_picture, short_description FROM product');
        $this->addSql('DROP TABLE product');
        $this->addSql('CREATE TABLE product (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, category_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, price INTEGER NOT NULL, slug VARCHAR(255) NOT NULL, main_picture VARCHAR(255) NOT NULL, short_description CLOB NOT NULL)');
        $this->addSql('INSERT INTO product (id, category_id, name, price, slug, main_picture, short_description) SELECT id, category_id, name, price, slug, main_picture, short_description FROM __temp__product');
        $this->addSql('DROP TABLE __temp__product');
        $this->addSql('CREATE INDEX IDX_D34A04AD12469DE2 ON product (category_id)');
        $this->addSql('DROP INDEX IDX_6117D13BA76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__purchase AS SELECT id, user_id, full_name, address, postal_code, city, total, status, purchased_at FROM purchase');
        $this->addSql('DROP TABLE purchase');
        $this->addSql('CREATE TABLE purchase (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER DEFAULT NULL, full_name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, postal_code VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, total INTEGER NOT NULL, status VARCHAR(255) NOT NULL, purchased_at DATETIME NOT NULL)');
        $this->addSql('INSERT INTO purchase (id, user_id, full_name, address, postal_code, city, total, status, purchased_at) SELECT id, user_id, full_name, address, postal_code, city, total, status, purchased_at FROM __temp__purchase');
        $this->addSql('DROP TABLE __temp__purchase');
        $this->addSql('CREATE INDEX IDX_6117D13BA76ED395 ON purchase (user_id)');
    }
}
