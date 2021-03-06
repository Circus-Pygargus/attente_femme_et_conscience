<?php

namespace App\Controller;

use App\Entity\FoodArticle;
use App\Entity\Recipe;
use App\Entity\RecipeCategory;
use App\Repository\Traits\RecipeTrait;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ArticleController
 * @package App\Controller\Admin
 * @Route("/alimentation-crue-et-vivante", name="raw_and_living_food")
 */
class RawAndLivingFoodController extends AbstractController
{
    use RecipeTrait;

    private array $navbarInfos;
    private array $navigationInfos;
    private array $contentNavigation;
    private array $content;
    private string $heroImgName;
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->heroImgName = 'recette-hero.jpg';
        $this->navbarInfos = [
            'page' => 'raw-and-living-food'
        ];
        $this->navigationInfos = [
            [
                'text' => 'Accueil',
                'urlPath' => 'home'
            ],
            [
                'text' => 'Alimentation crue et vivante',
                'urlPath' => 'raw_and_living_food'
            ]
        ];
        $this->contentNavigation = [];
        $this->content = [];
        $this->em = $entityManager;
    }

    /**
     * @Route("/", name="")
     */
    public function index (): Response
    {
        $this->contentNavigation = $this->getRecipesAndRelatedLinks($this->em);
        $this->contentNavigation['inUseRegex'] = 'raw_and_living_food';
        $this->content['page'] = 'Présentation';


        return $this->render('raw-and-living-food/index.html.twig', [
            'navbarInfos' => $this->navbarInfos,
            'navigationInfos' => $this->navigationInfos,
            'contentNavigation' => $this->contentNavigation,
            'content' => $this->content
        ]);
    }

    /**
     * @Route("/recettes-{slug}s", name="_category")
     */
    public function showRecipesByCategory (
        string $slug,
        Request $request,
        PaginatorInterface $paginator
    ): Response
    {
        $recipeCategory = $this->em->getRepository(RecipeCategory::class)->findOneBy(['slug' => $slug]);
        $this->navigationInfos[] = [
            'text' => 'Recettes ' . $recipeCategory->getLabel() . 's',
            'urlPath' => 'raw_and_living_food_category',
            'slug' => $slug
        ];
        $this->contentNavigation = $this->getRecipesAndRelatedLinks($this->em);
        $this->contentNavigation['inUseRegex'] = 'raw_and_living_food';
        $this->content = [
            'page' => 'Recettes ' . $recipeCategory->getLabel() . 's',
            'noContentMsg' => 'Pas de recettes ' . $recipeCategory->getLabel() . 's pour le moment.',
            'subLayout' => 'recipe.html.twig'
        ];

        $recipesData = $this->em
            ->getRepository(Recipe::class)
            ->findBy([
                'category' => $recipeCategory->getId(),
                'published' => true
            ],
            [
                'createdAt' => 'DESC'
            ],
            10, // limit
            0 // offset
       );

        $this->content['list'] = $paginator->paginate(
            $recipesData, // Requête contenant les données à paginer
            $request->query->getInt('page', 1), // Numéro de la page demandée via url, 1 si aucune page
            2 // le nombre de recettes par page
        );

        return $this->render('blog-content/index.html.twig', [
            'heroImgName' => $this->heroImgName,
            'navbarInfos' => $this->navbarInfos,
            'navigationInfos' => $this->navigationInfos,
            'contentNavigation' => $this->contentNavigation,
            'content' => $this->content
        ]);
    }

    /**
     * @Route("/recettes-{categorySlug}s/{elementSlug}", name="_recipe")
     */
    public function showOneRecipe (
        string $categorySlug,
        string $elementSlug
    ): Response
    {
        $recipeCategory = $this->em->getRepository(RecipeCategory::class)->findOneBy(['slug' => $categorySlug]);
        $recipe = $this->em->getRepository(Recipe::class)->findOneBy(['slug' => $elementSlug]);

        $this->navigationInfos[] = [
            'text' => 'Recettes ' . $recipeCategory->getLabel() . 's',
            'urlPath' => 'raw_and_living_food_category',
            'slug' => $categorySlug
        ];
        $this->navigationInfos[] = [
            'text' => $recipe->getSlug(),
            'urlPath' => 'raw_and_living_food_recipe',
            'categorySlug' => $categorySlug,
            'slug' => $elementSlug
        ];

        $this->contentNavigation = $this->getRecipesAndRelatedLinks($this->em);
        $this->contentNavigation['inUseRegex'] = 'raw_and_living_food';
        $this->content['element'] = $recipe;

        return $this->render('blog-content/index.html.twig', [
            'heroImgName' => $this->heroImgName,
            'navbarInfos' => $this->navbarInfos,
            'navigationInfos' => $this->navigationInfos,
            'contentNavigation' => $this->contentNavigation,
            'content' => $this->content
        ]);
    }

    /**
     * @Route("/articles", name="_articles")
     */
    public function showFoodArticles (
        Request $request,
        PaginatorInterface $paginator
    ): Response
    {

        $this->navigationInfos[] = [
            'text' => 'Articles liés à l\'alimentation',
            'urlPath' => 'raw_and_living_food_articles',
        ];
        $this->contentNavigation = $this->getRecipesAndRelatedLinks($this->em);
        $this->contentNavigation['inUseRegex'] = 'raw_and_living_food';
        $this->content = [
            'page' => 'Graines',
            'noContentMsg' => 'Pas d\articles liés à l\'alimentations pour le moment.',
            'subLayout' => 'food-article.html.twig'
        ];

        $foodArticlesData = $this->em
            ->getRepository(FoodArticle::class)
            ->findBy([
                'published' => true
            ],
            [
                'createdAt' => 'DESC'
            ],
            10, // limit
            0 // offset
        );

        $this->content['list'] = $paginator->paginate(
            $foodArticlesData, // Requête contenant les données à paginer
            $request->query->getInt('page', 1), // Numéro de la page demandée via url, 1 si aucune page
            2 // le nombre de recettes par page
        );

        return $this->render('blog-content/index.html.twig', [
            'heroImgName' => $this->heroImgName,
            'navbarInfos' => $this->navbarInfos,
            'navigationInfos' => $this->navigationInfos,
            'contentNavigation' => $this->contentNavigation,
            'content' => $this->content
        ]);
    }

    /**
     * @Route("/articles/{slug}", name="_article")
     */
    public function ShowOneFoodArticle ($slug): Response
    {
        $foodArticle = $this->em->getRepository(FoodArticle::class)->findOneBy(['slug' => $slug]);

        $this->navigationInfos[] = [
            'text' => 'Articles liés à l\'alimentation',
            'urlPath' => 'raw_and_living_food_articles',
        ];
        $this->navigationInfos[] = [
            'text' => $foodArticle->getTitle(),
            'urlPath' => 'raw_and_living_food_article',
            'slug' => $slug
        ];

        $this->contentNavigation = $this->getRecipesAndRelatedLinks($this->em);
        $this->contentNavigation['inUseRegex'] = 'raw_and_living_food';
        $this->content['page'] = 'Graines';
        $this->content['element'] = $foodArticle;

        return $this->render('blog-content/index.html.twig', [
            'heroImgName' => $this->heroImgName,
            'navbarInfos' => $this->navbarInfos,
            'navigationInfos' => $this->navigationInfos,
            'contentNavigation' => $this->contentNavigation,
            'content' => $this->content
        ]);
    }
}
