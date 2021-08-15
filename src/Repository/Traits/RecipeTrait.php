<?php

namespace App\Repository\Traits;

use App\Entity\Recipe;
use App\Entity\RecipeCategory;
use App\Repository\RecipeRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

Trait RecipeTrait
{
    protected function getRecipesAndRelatedLinks (EntityManagerInterface $entityManager): array
    {
        $title = 'Alimentation';
        $categories = [];
        $categories[] = [
            'name' => 'Présentation',
            'link' => 'raw_and_living_food'
        ];

        $emRecipeCategory = $entityManager->getRepository(RecipeCategory::class);
        $recipeCategories = $emRecipeCategory->findAll();

        $emRecipe = $entityManager->getRepository(Recipe::class);
        foreach ($recipeCategories as $recipeCategory) {
            $sweetyRecipes = $emRecipe->findBy([
                'category' => $recipeCategory->getId(),
                'published' => true
                ],
                [
                    'createdAt' => 'DESC'
                ],
                10, // limit
                0 // offset
            );
            $categories[] = [
                'name' => 'Recettes ' . $recipeCategory->getLabel() . 's',
                'link' => 'raw_and_living_food_category',
                'linkAddSlug' => $recipeCategory->getSlug(),
                'urlPathForLinks' => 'raw_and_living_food_recipe',
                'links' => $sweetyRecipes
            ];
        }

        return [
            'title' => $title,
            'categories' => $categories
        ];
    }
}
