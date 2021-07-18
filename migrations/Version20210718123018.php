<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210718123018 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article_key_word (article_id INT NOT NULL, key_word_id INT NOT NULL, INDEX IDX_101E5AB37294869C (article_id), INDEX IDX_101E5AB3818167B3 (key_word_id), PRIMARY KEY(article_id, key_word_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE key_word (id INT AUTO_INCREMENT NOT NULL, key_word VARCHAR(60) NOT NULL, slug VARCHAR(60) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article_key_word ADD CONSTRAINT FK_101E5AB37294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_key_word ADD CONSTRAINT FK_101E5AB3818167B3 FOREIGN KEY (key_word_id) REFERENCES key_word (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_key_word DROP FOREIGN KEY FK_101E5AB3818167B3');
        $this->addSql('DROP TABLE article_key_word');
        $this->addSql('DROP TABLE key_word');
    }
}
