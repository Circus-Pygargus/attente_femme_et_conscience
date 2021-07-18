<?php

namespace App\Controller;

use App\Repository\Traits\AccompanimentAndFormationTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    use AccompanimentAndFormationTrait;

    private string $heroImgName = 'article-hero.jpg';

    /**
     * @Route("/produits", name="products")
     */
    public function list (): Response
    {
        $navbarInfos = [
            'page' => 'accompaniment-and-formation'
        ];
        $navigationInfos = [
            [
                'text' => 'Accueil',
                'urlPath' => 'home'
            ],
            [
                'text' => 'Produits',
                'urlPath' => 'products'
            ]
        ];
//        $contentNavigation = [
//            'title' => 'Accompagnements & Formations',
//            'categories' => [
//                [
//                    'name' => 'Les prochains rendez-vous',
//                    'link' => 'rendez_vous'
//                ],
//                [
//                    'name' => 'Accompagnements en présentiel',
//                    'link' => 'presential_accompaniments',
//                    'links' => [
//                        [
//                            'slug' => '2',
//                            'title' => 'à la découverte de mon corps de femme et de ma sensualité'
//                        ],
//                        [
//                            'slug' => '3',
//                            'title' => 'Atelier de Yoni'
//                        ],
//                        [
//                            'slug' => '4',
//                            'title' => 'Cercle de lune'
//                        ],
//                        [
//                            'slug' => '5',
//                            'title' => 'Cercle de paroles'
//                        ],
//                        [
//                            'slug' => '6',
//                            'title' => 'Soins de la matrice'
//                        ],
//                        [
//                            'slug' => '7',
//                            'title' => 'Initiation soins Isis'
//                        ],
//                        [
//                            'slug' => '8',
//                            'title' => 'Reiki Usu'
//                        ]
//                    ]
//                ]
//            ]
//        ];
        $contentNavigation = $this->getAccompanimentsAndFormationsLinks();
        $content = [
            'page' => 'Produits',
            'list' => [
                0 => [
                    'title' => 'Produit 1'
                ],
                1 => [
                    'title' => 'Produit 2'
                ]
            ]
        ];

        return $this->render('blog-content/index.html.twig', [
            'heroImgName' => $this->heroImgName,
            'navbarInfos' => $navbarInfos,
            'navigationInfos' => $navigationInfos,
            'contentNavigation' => $contentNavigation,
            'content' => $content
        ]);
    }
}
