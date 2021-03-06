<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AdminController;
use App\Entity\Recipe;
use App\Form\Recipe\AddRecipeFormType;
use App\Form\Recipe\EditRecipeFormType;
use App\Form\Recipe\PublishRecipeFormType;
use App\Repository\RecipeRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class RecipeController
 * @package App\Controller\Admin
 * @Route("/admin/recettes", name="admin_recipes_")
 */
class RecipeController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->contentNavigation['inUseRegex'] = 'admin_recipes';
    }

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

        // Pour les formulaires de publication ou de suppression de recette
        // un seul formulaire de chaque, géré en js
        $message = '';
        $recipe = new Recipe();
        $publishForm = $this->createForm(PublishRecipeFormType::class, $recipe);

        $publishForm->handleRequest($request);

        if ($publishForm->isSubmitted() && $publishForm->isValid()) {
            $newInfosRecipe = $publishForm->getData();
            $recipe = $recipeRepository->findOneBy(['slug' => $newInfosRecipe->getSlug()]);
            $recipe->setPublished($newInfosRecipe->getPublished());
            $doctrine = $this->getDoctrine()->getManager();
            $doctrine->persist($recipe);
            $doctrine->flush();

            if ($recipe->getPublished()) {
                $message = 'La recette <b>' . $recipe->getTitle() . '</b> est maintenant publiée.';
            } else {
                $message = 'La recette <b>' . $recipe->getTitle() . '</b> n\'est plus publiée.';
            }
        }

        // Pour la liste des recettes
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
            'recipePublishForm' => $publishForm->createView(),
            'lastRecipeMessage' => $message,
            'recipes' => $recipes
        ]);
    }

    /**
     * @Route("/nouvelle", name="create")
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

        $recipe = new Recipe();

        $form = $this->createForm(AddRecipeFormType::class, $recipe);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $recipe->setPublished(false);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($recipe);
            $entityManager->flush();

            return $this->redirectToRoute('admin_recipes_list');
        }

        return $this->render('admin/recipe/create.html.twig', [
            'heroImgName' => $this->heroImgName,
            'navigationInfos' => $this->navigationInfos,
            'contentNavigation' => $this->contentNavigation,
            'recipeForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/edite/{slug}", name="edit")
     */
    public function edit (
        string $slug = '',
        Request $request,
        RecipeRepository $recipeRepository
    ): Response
    {
        $this->navigationInfos[] = [
            'text' => 'Gérer les recettes',
            'urlPath' => 'admin_recipes_list'
        ];
        $this->navigationInfos[] = [
            'text' => 'Éditer une recettes',
            'urlPath' => 'admin_recipes_edit'
        ];

        if ($slug != '') {
            $recipe = $recipeRepository->findOneBy(['slug' => $slug]);
        } else {
            dd('Etrange');
            $recipe = new Recipe();
        }

        $form = $this->createForm(EditRecipeFormType::class, $recipe);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($recipe);
            $em->flush();

            return $this->redirectToRoute('admin_recipes_list');
        }

        return $this->render('admin/recipe/edit.html.twig', [
            'heroImgName' => $this->heroImgName,
            'navigationInfos' => $this->navigationInfos,
            'contentNavigation' => $this->contentNavigation,
            'recipeForm' => $form->createView()
        ]);
    }
}
