<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{

    protected string $heroImgName;
    protected array $navigationInfos;
    protected array $contentNavigation;

    public function __construct ()
    {
        $this->heroImgName = 'green-mountains.jpg';
        $this->navigationInfos = [
            [
                'text' => 'Accueil',
                'urlPath' => 'home'
            ],
            [
                'text' => 'Gestion',
                'urlPath' => 'admin'
            ]
        ];
        $this->contentNavigation = [
            'title' => 'Gestion',
            'inUseRegex' => 'admin_base',
            'specialLinks' => [
                [
                    'label' => 'Articles',
                    'urlPath' => 'admin_articles_list'
                ],
                [
                    'label' => 'Rendez-vous',
                    'urlPath' => 'admin_rendez_vous_list'
                ],
                [
                    'label' => 'Accompagnements en présentiel',
                    'urlPath' => 'admin_presential_accompaniments_list'
                ],
                [
                    'label' => 'Formations à distance',
                    'urlPath' => 'admin_distance_learnings_list'
                ],
                [
                    'label' => 'Recettes',
                    'urlPath' => 'admin_recipes_list'
                ],
                [
                    'label' => 'Articles nourriture',
                    'urlPath' => 'admin_food_articles_list'
                ],
                [
                    'label' => 'produits',
                    'urlPath' => 'admin_products_list'
                ],
                [
                    'label' => 'Lettres d\'informations',
                    'urlPath' => 'admin_newsletters_list'
                ],
                [
                    'label' => 'Corbeille',
                    'urlPath' => 'admin'
                ]
            ]
        ];
    }

    /**
     * @Route("/gestion", name="admin")
     */
    public function index(): Response
    {

        return $this->render('admin/index.html.twig', [
            'heroImgName' => $this->heroImgName,
            'navigationInfos' => $this->navigationInfos,
            'contentNavigation' => $this->contentNavigation
        ]);
    }
}
