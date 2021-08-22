<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AdminController;
use App\Entity\Article;
use App\Entity\FoodArticle;
use App\Form\Article\EditFoodArticleFormType;
use App\Form\FoodArticle\AddFoodArticleFormType;
use App\Form\FoodArticle\PublishFoodArticleFormType;
use App\Repository\FoodArticleRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * class FoodArticleController
 * @package App\Controller\Admin
 * @Route("/gestion/food-articles", name="admin_food_articles_")
 */
class FoodArticleController extends AdminController
{
    /**
     * @Route("/", name="list")
     */
    public function list (
        Request $request,
        FoodArticleRepository $foodArticleRepository,
        PaginatorInterface $paginator
    )
    {
        $this->navigationInfos[] = [
            'text' => 'Gérer les articles liés à la nourriture',
            'urlPath' => 'admin_food_articles_list'
        ];

        // Pour les formulaires de publication ou de suppression d'article
        // un seul formulaire de chaque, géré en js
        $message = '';
        $foodArticle = new FoodArticle();
        $publishForm = $this->createForm(PublishFoodArticleFormType::class, $foodArticle);

        $publishForm->handleRequest($request);

        if ($publishForm->isSubmitted() && $publishForm->isValid()) {
            $newInfos = $publishForm->getData();
            $foodArticle = $foodArticleRepository->findOneBy(['slug' => $newInfos->getSlug()]);
            $foodArticle->setPublished($newInfos->getPublished());
            $doctrine = $this->getDoctrine()->getManager();
            $doctrine->persist($foodArticle);
            $doctrine->flush();

            if ($foodArticle->getPublished()) {
                $message = 'L\'article <b>' . $foodArticle->getTitle() . '</b> est maintenant publié.';
            } else {
                $message = 'L\'article <b>' . $foodArticle->getTitle() . '</b> n\'est plus publié.';
            }
        }

        // Pour la liste des articles
        $foodArticlesData = $foodArticleRepository->getFoodArticlesAdminList();

        $foodArticles = $paginator->paginate(
            $foodArticlesData, // Requête contenant les données à paginer
            $request->query->getInt('page', 1), // Numéro de la page demandée via url, 1 si aucune page
            2 // le nombre d'articles par page
        );

        return $this->render('admin/food-article/list.html.twig', [
            'heroImgName' => $this->heroImgName,
            'navigationInfos' => $this->navigationInfos,
            'contentNavigation' => $this->contentNavigation,
            'foodArticlePublishForm' => $publishForm->createView(),
            'lastFoodArticleMessage' => $message,
            'foodArticles' => $foodArticles
        ]);
    }

    /**
     * @Route("/nouveau", name="create")
     */
    public function create (Request $request): Response
    {
        $this->navigationInfos[] = [
            'text' => 'Gérer les articles liés à la nourriture',
            'urlPath' => 'admin_food_articles_list'
        ];
        $this->navigationInfos[] = [
            'text' => 'Créer un article lié à la nourriture',
            'urlPath' => 'admin_food_articles_create'
        ];
        $this->contentNavigation['inUseRegex'] = 'admin_food_articles';

        $foodArticle = new FoodArticle();

        $form = $this->createForm(AddFoodArticleFormType::class, $foodArticle);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $foodArticle->setUser($this->getUser());
            $foodArticle->setPublished(false);

            $doctrine = $this->getDoctrine()->getManager();
            $doctrine->persist($foodArticle);
            $doctrine->flush();

            return $this->redirectToRoute('admin_food_articles_list');
        }

        return $this->render('admin/food-article/create.html.twig', [
            'heroImgName' => $this->heroImgName,
            'navigationInfos' => $this->navigationInfos,
            'contentNavigation' => $this->contentNavigation,
            'foodArticleForm' => $form->createView()
        ]);
    }

    /**
     * @Route("edite/{slug}", name="edit")
     */
    public function edit (
        string $slug = '',
        Request $request,
        FoodArticleRepository $foodArticleRepository
    ): Response
    {
        $this->navigationInfos[] = [
            'text' => 'Gérer les articles liés à  la nourriture',
            'urlPath' => 'admin_food_articles_list'
        ];
        $this->navigationInfos[] = [
            'text' => 'Éditer un article lié à la nourriture',
            'urlPath' => 'admin_food_articles_edit'
        ];
        $this->contentNavigation['inUseRegex'] = 'admin_articles';

        if ($slug !== '') {
            $foodArticle = $foodArticleRepository->findOneBy(['slug' => $slug]);
        } else {
            // TODO modifier pour un message d'erreur ??? et le faire pour toutes les entités !!!
            $foodArticle = new Article();
        }

        $form = $this->createForm(EditFoodArticleFormType::class, $foodArticle);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $doctrine = $this->getDoctrine()->getManager();
            $doctrine->persist($foodArticle);
            $doctrine->flush();
            return $this->redirectToRoute('admin_food_articles_list');
        }

        return $this->render('admin/food-article/edit.html.twig', [
            'heroImgName' => $this->heroImgName,
            'navigationInfos' => $this->navigationInfos,
            'contentNavigation' => $this->contentNavigation,
            'foodArticleForm' => $form->createView()
        ]);
    }
}
