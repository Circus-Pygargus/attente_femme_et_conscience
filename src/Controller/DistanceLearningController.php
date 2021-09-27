<?php

namespace App\Controller;

use App\Repository\Traits\AccompanimentAndFormationTrait;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DistanceLearningController extends AbstractController
{
    use AccompanimentAndFormationTrait;

    private string $heroImgName;
    private array  $navbarInfos;
    private array  $navigationInfos;
    private array $contentNavigation;

    public function __construct ()
    {
        $this->heroImgName = 'article-hero.jpg';
        $this->navbarInfos = [
            'page' => 'accompaniment-and-formation'
        ];
        $this->navigationInfos = [
            [
                'text' => 'Accueil',
                'urlPath' => 'home'
            ],
            [
                'text' => 'Formations à distance',
                'urlPath' => 'distance-learning'
            ]
        ];
        $this->contentNavigation = $this->getAccompanimentsAndFormationsLinks();
    }

    /**
     * @Route("/formations-a-distance", name="distance-learning")
     */
    public function list (
        Request $request,
        PaginatorInterface $paginator
    ): Response
    {
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
        $content = [
            'page' => 'Les formations à distance',
            'noContentMsg' => 'Pas de formation à distance prévue pour le moment.',
            'subLayout' => 'distance-learning.html.twig',
//            'list' => [
//                0 => [
//                    'title' => 'Distance 1'
//                ],
//                1 => [
//                    'title' => 'Distance 2'
//                ]
//            ]
        ];

        $distanceLearningsData = [
            0 => [
                'slug' => 'distance_1',
                'title' => 'Distance 1'
            ],
            1 => [
                'slug' => 'distance_2',
                'title' => 'Distance 2'
            ]
        ];

        $content['list'] = $paginator->paginate(
            $distanceLearningsData, // Requête contenant les données à paginer
            $request->query->getInt('page', 1), // Numéro de la page demandée via url, 1 si aucune page
            2 // le nombre d'articles par page
        );

        return $this->render('blog-content/index.html.twig', [
            'heroImgName' => $this->heroImgName,
            'navbarInfos' => $this->navbarInfos,
            'navigationInfos' => $this->navigationInfos,
            'contentNavigation' => $this->contentNavigation,
            'content' => $content
        ]);
    }
}
