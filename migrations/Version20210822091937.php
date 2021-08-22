<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210822091937 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE food_article (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, slug VARCHAR(128) NOT NULL, title VARCHAR(255) NOT NULL, featured_image VARCHAR(255) NOT NULL, featured_image_alt VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, published TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, key_word_string VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_4DA5D25E989D9B62 (slug), INDEX IDX_4DA5D25EA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE food_article ADD CONSTRAINT FK_4DA5D25EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE food_article');
    }
}
