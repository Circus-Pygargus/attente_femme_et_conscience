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
            'adminLinks' => [
                [
                    'label' => 'Articles',
                    'urlPath' => 'admin_articles_list'
                ],
                [
                    'label' => 'Rendez-vous',
                    'urlPath' => 'admin'
                ],
                [
                    'label' => 'Lettres d\'informations',
                    'urlPath' => 'admin'
                ],
                [
                    'label' => 'Corbeille',
                    'urlPath' => 'admin'
                ]
            ]
        ];
    }

    /**
     * @Route("/admin", name="admin")
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
