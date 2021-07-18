<?php

namespace App\Controller;

use App\Repository\Traits\AccompanimentAndFormationTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PresentialAccompanimentController extends AbstractController
{
    use AccompanimentAndFormationTrait;

    private string $heroImgName = 'article-hero.jpg';

    /**
     * @Route("/accompagnements-en-presentiel", name="presential_accompaniments")
     */
    public function list (): Response
    {
        $navbarInfos = [
            'page' => 'presential-acccompaniments'
        ];
        $navigationInfos = [
            [
                'text' => 'Accueil',
                'urlPath' => 'home'
            ],
            [
                'text' => 'Accompagnements en présentiel',
                'urlPath' => 'presential_accompaniments'
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
//        array_unshift($contentNavigation, )
        $content = [
            'page' => 'Accompagnements en présentiel',
            'list' => [
                0 => [
                    'title' => 'Présentiel 1'
                ],
                1 => [
                    'title' => 'Présentiel 2'
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
