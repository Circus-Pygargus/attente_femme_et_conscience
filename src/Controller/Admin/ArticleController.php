<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AdminController;
use App\Entity\Article;
use App\Form\AddArticleFormType;
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
    public function list ()
    {
        $this->navigationInfos[] = [
            'text' => 'Gérer les articles',
            'urlPath' => 'admin_articles_list'
        ];
        $articles = [
            [
                'title' => 'Reprenons notre pouvoir',
                'published' => true
            ],
            [
                'title' => 'Article 2',
                'published' => false
            ]
        ];
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

        return $this->render('admin/article/create.html.twig', [
            'heroImgName' => $this->heroImgName,
            'navigationInfos' => $this->navigationInfos,
            'contentNavigation' => $this->contentNavigation,
            'articleForm' => $form->createView()
        ]);
    }
}
