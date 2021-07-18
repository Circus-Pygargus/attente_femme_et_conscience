<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ArticleController
 * @package App\Controller
 * @Route("/articles", name="articles_")
 */
class ArticleController extends AbstractController
{
    private string $heroImgName = 'article-hero.jpg';

    /**
     * @Route("/", name="list")
     */
    public function list (): Response
    {
        $navbarInfos = [
            'page' => 'articles'
        ];
        $navigationInfos = [
            [
                'text' => 'Accueil',
                'urlPath' => 'home'
            ],
            [
                'text' => 'Articles',
                'urlPath' => 'articles_list'
            ]
        ];
        $contentNavigation = [
            'title' => 'Articles',
            'subLink' => 'articles_show_one',
            'links' => [
                [
                    'slug' => '1',
                    'title' => 'Reprenons notre pouvoir'
                ],
                [
                    'slug' => '2',
                    'title' => 'article 2'
                ],
                [
                    'slug' => '3',
                    'title' => 'article 3'
                ],
                [
                    'slug' => '4',
                    'title' => 'article 4'
                ]
            ]
        ];
        $content = [
            'subLayout' => 'article.html.twig',
            'list' => [
                0 => [
                    'title' => 'Reprenons notre pouvoir'
                ],
                1 => [
                    'title' => 'Article 2'
                ]
            ]
        ];

        return $this->render('blog-content/index.html.twig', [
            'heroImgName' => $this->heroImgName,
            'navbarInfos' => $navbarInfos,
            'navigationInfos' => $navigationInfos,
            'contentNavigation' => $contentNavigation,
            'content' =>$content
        ]);
    }

    /**
     * @Route("/{slug}", name="show_one")
     */
    public function showOne ($slug): Response
    {
        $navbarInfos = [
            'page' => 'articles'
        ];
        $navigationInfos = [
            [
                'text' => 'Accueil',
                'urlPath' => 'home'
            ],
            [
                'text' => 'Articles',
                'urlPath' => 'articles_list'
            ],
            [
                'text' => 'Reprenons notre pouvoir',
                'urlPath' => 'articles_show_one',
                'slug' => '1'
            ]
        ];
        $contentNavigation = [
            'title' => 'Articles',
            'subLink' => 'articles_show_one',
            'links' => [
                [
                    'category' => 'articles',
                    'slug' => '1',
                    'title' => 'Reprenons notre pouvoir'
                ],
                [
                    'category' => 'articles',
                    'slug' => '2',
                    'title' => 'article 2'
                ],
                [
                    'category' => 'articles',
                    'slug' => '3',
                    'title' => 'article 3'
                ],
                [
                    'category' => 'articles',
                    'slug' => '4',
                    'title' => 'article 4'
                ]
            ]
        ];
        $content = [
            'slug' => '1',
            'title' => 'Reprenons notre pouvoir',
            'text' => '<p>Dans ce que l’on peut voir, entendre ou lire concernant les Femmes
actuellement, nous avons en tant que Femme notre responsabilité.
Nous pouvons chacune à notre niveau être actrice du changement.</p><p>Pour paraphraser la citation de Gandhi :
“Femmes, soyez le changement que vous voulez voir dans ce monde !”</p><p>La Bienveillance comment d’abord par nous-même.
Et elle est aussi à l’égard des autres Femmes. </p>'
        ];

        return $this->render('blog-content/index.html.twig', [
            'heroImgName' => $this->heroImgName,
            'navbarInfos' => $navbarInfos,
            'navigationInfos' => $navigationInfos,
            'contentNavigation' => $contentNavigation,
            'content' =>$content
        ]);
    }
}
