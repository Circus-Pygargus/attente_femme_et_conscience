<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AdminController;
use App\Entity\Article;
use App\Form\AddArticleFormType;
use App\Repository\ArticleRepository;
use App\Repository\KeyWordRepository;
use Doctrine\Common\Collections\Collection;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ArticleController
 * @package App\Controller\Admin
 * @Route("/admin/articles", name="admin_articles_")
 */
class ArticleController extends AdminController
{
    /**
     * @Route("/", name="list")
     */
    public function list (
        Request $request,
        ArticleRepository $articleRepository,
        PaginatorInterface $paginator
    ): Response
    {
        $this->navigationInfos[] = [
            'text' => 'Gérer les articles',
            'urlPath' => 'admin_articles_list'
        ];
        $données = $articleRepository->getArticlesAdminList();

        $articles = $paginator->paginate(
            $données, // Requête contenant les données à paginer
            $request->query->getInt('page', 1), // Numéro de la page demandée via url, 1 si aucune page
            25 // le nombre d'articles par page
        );

        return $this->render('admin/article/list.html.twig', [
            'heroImgName' => $this->heroImgName,
            'navigationInfos' => $this->navigationInfos,
            'contentNavigation' => $this->contentNavigation,
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/create", name="create")
     */
    public function create (Request $request)
    {
        $this->navigationInfos[] = [
            'text' => 'Gérer les articles',
            'urlPath' => 'admin_articles_list'
        ];
        $this->navigationInfos[] = [
            'text' => 'Créer un article',
            'urlPath' => 'admin_articles_create'
        ];
        $this->contentNavigation['inUseRegex'] = 'admin_articles';

        $article = new Article();

        $form = $this->createForm(AddArticleFormType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $article->setUser($this->getUser());
            // Todo décommenter une fois functionnel
//            $article = $this->handleKeyWordsOnCreation($article);
            $doctrine = $this->getDoctrine()->getManager();
            $doctrine->persist($article);
            $doctrine->flush();
            return $this->redirectToRoute('admin_articles_list');

        }

        return $this->render('admin/article/create.html.twig', [
            'heroImgName' => $this->heroImgName,
            'navigationInfos' => $this->navigationInfos,
            'contentNavigation' => $this->contentNavigation,
            'articleForm' => $form->createView()
        ]);
    }



    /**
     * Récupère les mot-clés du form de création d'article
     * Enregistre les nouveaux mots clés en base
     *
     * @var Article
     * @return Article contenant la collection de KeyWord
     */
//    public function handleKeyWordsOnCreation (Article $article): Article
//    {
//        $keyWordsCollection = [];
//        $keyWordsArray = explode(',', $article->getKeyWordsString());
//        $keyWordRepo = new KeyWordRepository();
//        foreach ($keyWordsArray as $keyWordStr) {
//            $keyWord = $keyWordRepo->findOneBy(['$keyWord' => $keyWordStr]);
//
//        }
//
//        return $keyWordsCollection;
//    }
}
