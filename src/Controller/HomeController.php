<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        $lastArticle = [
            'title' => 'Reprenons notre pouvoir',
            'image' => 'valerie-rv.jpg',
            'excerpt' => 'À nos grand-mères… À celles qui n’ont pas enfanté et qui ne sont pas moins Femme, car elles portent en elles, cette essence, qui fait que par nature, elles ont cette capacité de donner cet Amour Universel. Aux hommes qui cherchent, à comprendre la nature féminine ...'
        ];
        $rendezVousList = [
            [
                'img' => 'valerie-rv.jpg',
                'imgAlt' => 'une photo de Valérie',
                'date' => 'Samedi 12 au 15 mai 2021 de 8h30 à 17h',
                'title' => 'LABORE ET DOLORE',
                'text' => 'Sed do eiusmod tempor incididunt ut labore et doloremagna aliqua. Ut enim ad minim veniam, quisnostrud exercitation ullamco laboris nisi ut'
            ],
            [
                'img' => 'valerie-rv.jpg',
                'imgAlt' => 'une photo de Valérie',
                'date' => 'Samedi 12 au 15 mai 2021 de 8h30 à 17h',
                'title' => 'LABORE ET DOLORE',
                'text' => 'Sed do eiusmod tempor incididunt ut labore et doloremagna aliqua. Ut enim ad minim veniam, quisnostrud exercitation ullamco laboris nisi ut'
            ],
            [
                'img' => 'valerie-rv.jpg',
                'imgAlt' => 'une photo de Valérie',
                'date' => 'Samedi 12 au 15 mai 2021 de 8h30 à 17h',
                'title' => 'LABORE ET DOLORE',
                'text' => 'Sed do eiusmod tempor incididunt ut labore et doloremagna aliqua. Ut enim ad minim veniam, quisnostrud exercitation ullamco laboris nisi ut'
            ],
            [
                'img' => 'valerie-rv.jpg',
                'imgAlt' => 'une photo de Valérie',
                'date' => 'Samedi 12 au 15 mai 2021 de 8h30 à 17h',
                'title' => 'LABORE ET DOLORE',
                'text' => 'Sed do eiusmod tempor incididunt ut labore et doloremagna aliqua. Ut enim ad minim veniam, quisnostrud exercitation ullamco laboris nisi ut'
            ],
        ];
        $recentArticles = [
            [
                'id' => 1,
                'title' => 'Reprennons notre pouvoir'
            ],
            [
                'id' => 2,
                'title' => 'Être ou ne pas être une femme, un homme'
            ],
            [
                'id' => 3,
                'title' => 'Le sang des femmes'
            ],
            [
                'id' => 4,
                'title' => 'Les hommes nouveaux'
            ],
            [
                'id' => 5,
                'title' => 'La “faute” des mères'
            ]
        ];
        $accompaniments = [
            [
                'slug' => '1',
                'img' => 'valerie.jpg',
                'imgAlt' => 'une photo de Valérie',
                'title' => 'À la découvert de mon corps de femme et de ma sensualité',
                'text' => 'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation . Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation .'
            ],
            [
                'slug' => '2',
                'img' => 'valerie.jpg',
                'imgAlt' => 'une photo de Valérie',
                'title' => 'Atelier oeuf de Yioni',
                'text' => 'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation . Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation .'
            ],
            [
                'slug' => '3',
                'img' => 'valerie.jpg',
                'imgAlt' => 'une photo de Valérie',
                'title' => 'Cercle de lune',
                'text' => 'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation . Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation .'
            ],
            [
                'slug' => '4',
                'img' => 'valerie.jpg',
                'imgAlt' => 'Cercle de paroles',
                'title' => 'À la découvert de mon corps de femme et de ma sensualité',
                'text' => 'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation . Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation .'
            ],
            [
                'slug' => '5',
                'img' => 'valerie.jpg',
                'imgAlt' => 'une photo de Valérie',
                'title' => 'Soins de la matrice',
                'text' => 'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation . Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation .'
            ],
            [
                'slug' => '6',
                'img' => 'valerie.jpg',
                'imgAlt' => 'une photo de Valérie',
                'title' => 'Initiation soins Isis',
                'text' => 'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation . Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation .'
            ],
            [
                'slug' => '7',
                'img' => 'valerie.jpg',
                'imgAlt' => 'une photo de Valérie',
                'title' => 'REIKI USUI',
                'text' => 'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation . Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation .'
            ]
        ];
        $distanceLearnings = [
            [
                'title' => 'Mon cercle de lune',
                'text' => 'Votre Cercle de Lune depuis chez vous en toute autonomie, seul ou accompagné.'
            ],
            [
                'title' => 'Initiation soins Isis',
                'text' => 'Formez-vous à distance aux soins énergétiques d’Isis.'
            ]
        ];
        $products = [
            [
                'title' => 'Mon bâton de lune',
                'text' => 'Mettez de la couleur à votre cycle menstruel et à vos émotions.',
                'info' => 'Application de développement personnel à télécharger'
            ],
            [
                'title' => 'Ma poupée de lune ou Matriochka',
                'text' => 'Pour honorer sa Féminité au quotidien, à la fois objet de décoration et de soin.',
                'info' => 'Objet artisanal délivré par voie postale'
            ]
        ];
        $navbarInfos = [
            'page' => 'home'
        ];


        return $this->render('home/index.html.twig', [
            'lastArticle'  => $lastArticle,
            'rendezVous' => $rendezVousList,
            'recentArticles' => $recentArticles,
            'accompaniments' => $accompaniments,
            'distanceLearnings' => $distanceLearnings,
            'products' => $products,
            'navbarInfos' => $navbarInfos
        ]);
    }
}
