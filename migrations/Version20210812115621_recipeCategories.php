<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210812115621_recipeCategories extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Insertion/suppression des catégories de recettes possibles';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("INSERT INTO recipe_category (value, label) VALUES ('sweety', 'sucrée');");
        $this->addSql("INSERT INTO recipe_category (value, label) VALUES ('salty', 'salée');");
    }

    public function down(Schema $schema): void
    {
        $this->addSql("DELETE FROM recipe_category WHERE value LIKE 'salty'");
        $this->addSql("DELETE FROM recipe_category WHERE value LIKE 'sweety'");
    }
}
