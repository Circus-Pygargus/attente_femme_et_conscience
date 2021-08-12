<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AdminController;
use App\Entity\Recipe;
use App\Form\Recipe\AddRecipeFormType;
use App\Repository\RecipeRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class RecipeController
 * @package App\Controller\Admin
 * @Route("/admin/recipes", name="admin_recipes_")
 */
class RecipeController extends AdminController
{
    /**
     * @Route("/", name="list")
     */
    public function list (
        Request $request,
        RecipeRepository $recipeRepository,
        PaginatorInterface $paginator
    ): Response
    {
        $this->navigationInfos[] = [
            'text' => 'Gérer les recettes',
            'urlPath' => 'admin_recipes_list'
        ];

        $recipeData = $recipeRepository->findAll();

        $recipes = $paginator->paginate(
            $recipeData, // Requête contenant les données à paginer
            $request->query->getInt('page', 1), // Numéro de la page demandée via url, 1 si aucune page
            2 // le nombre d'articles par page
        );

        return $this->render('admin/recipe/list.html.twig', [
            'heroImgName' => $this->heroImgName,
            'navigationInfos' => $this->navigationInfos,
            'contentNavigation' => $this->contentNavigation,
            'recipes' => $recipes
        ]);
    }

    /**
     * @Route("/create", name="create")
     */
    public function create (Request $request): Response
    {
        $this->navigationInfos[] = [
            'text' => 'Gérer les recettes',
            'urlPath' => 'admin_recipes_list'
        ];
        $this->navigationInfos[] = [
            'text' => 'Créer une recette',
            'urlPath' => 'admin_recipes_create'
        ];
        $this->contentNavigation['inUseRegex'] = 'admin_recipes';

        $recipe = new Recipe();

        $form = $this->createForm(AddRecipeFormType::class, $recipe);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($recipe);
            $entityManager->flush();
        }

        return $this->render('admin/recipe/create.html.twig', [
            'heroImgName' => $this->heroImgName,
            'navigationInfos' => $this->navigationInfos,
            'contentNavigation' => $this->contentNavigation,
            'recipeForm' => $form->createView()
        ]);
    }
}
