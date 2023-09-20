<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230920104401 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categories_posts (category_id INT NOT NULL, post_id INT NOT NULL, PRIMARY KEY(category_id, post_id))');
        $this->addSql('CREATE INDEX IDX_8C5EAFB712469DE2 ON categories_posts (category_id)');
        $this->addSql('CREATE INDEX IDX_8C5EAFB74B89032C ON categories_posts (post_id)');
        $this->addSql('ALTER TABLE categories_posts ADD CONSTRAINT FK_8C5EAFB712469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE categories_posts ADD CONSTRAINT FK_8C5EAFB74B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE categories_postscode DROP CONSTRAINT fk_5134c8a912469de2');
        $this->addSql('ALTER TABLE categories_postscode DROP CONSTRAINT fk_5134c8a94b89032c');
        $this->addSql('DROP TABLE categories_postscode');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE TABLE categories_postscode (category_id INT NOT NULL, post_id INT NOT NULL, PRIMARY KEY(category_id, post_id))');
        $this->addSql('CREATE INDEX idx_5134c8a94b89032c ON categories_postscode (post_id)');
        $this->addSql('CREATE INDEX idx_5134c8a912469de2 ON categories_postscode (category_id)');
        $this->addSql('ALTER TABLE categories_postscode ADD CONSTRAINT fk_5134c8a912469de2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE categories_postscode ADD CONSTRAINT fk_5134c8a94b89032c FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE categories_posts DROP CONSTRAINT FK_8C5EAFB712469DE2');
        $this->addSql('ALTER TABLE categories_posts DROP CONSTRAINT FK_8C5EAFB74B89032C');
        $this->addSql('DROP TABLE categories_posts');
    }
}
