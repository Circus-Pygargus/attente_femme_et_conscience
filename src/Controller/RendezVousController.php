<?php

namespace App\Controller;

use App\Repository\Traits\AccompanimentAndFormationTrait;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RendezVousController extends AbstractController
{
    use AccompanimentAndFormationTrait;

    private string $heroImgName = 'article-hero.jpg';

    /**
     * @Route("/rendez-vous", name="rendez_vous")
     */
    public function list (
        Request $request,
        PaginatorInterface $paginator
    ): Response
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
                'text' => 'Rendez-vous',
                'urlPath' => 'rendez_vous'
            ]
        ];
        $contentNavigation = $this->getAccompanimentsAndFormationsLinks();
        $content = [
            'page' => 'Les prochains rendez-vous',
            'noContentMsg' => 'Pas de rendez-vous prévu pour le moment.',
            'subLayout' => 'rendez-vous.html.twig',
//            'list' => [
//                0 => [
//                    'title' => 'Rendez-vous 1',
//                    'img' => 'valerie-rv.jpg',
//                    'date' => 'Samedi 12 au 15 mai 2021 de 8h30 à 17h',
//                    'title' => 'LABORE ET DOLORE',
//                    'text' => 'Sed do eiusmod tempor incididunt ut labore et doloremagna aliqua. Ut enim ad minim veniam, quisnostrud exercitation ullamco laboris nisi ut'
//                ],
//                1 => [
//                    'title' => 'Rendez-vous 2',
//                    'img' => 'valerie-rv.jpg',
//                    'date' => 'Samedi 12 au 15 mai 2021 de 8h30 à 17h',
//                    'title' => 'LABORE ET DOLORE',
//                    'text' => 'Sed do eiusmod tempor incididunt ut labore et doloremagna aliqua. Ut enim ad minim veniam, quisnostrud exercitation ullamco laboris nisi ut'
//                ]
//            ]
        ];

        $rendezVousData = [
            0 => [
                'title' => 'Rendez-vous 1',
                'img' => 'valerie-rv.jpg',
                'date' => 'Samedi 12 au 15 mai 2021 de 8h30 à 17h',
                'title' => 'LABORE ET DOLORE',
                'text' => 'Sed do eiusmod tempor incididunt ut labore et doloremagna aliqua. Ut enim ad minim veniam, quisnostrud exercitation ullamco laboris nisi ut'
            ],
            1 => [
                'title' => 'Rendez-vous 2',
                'img' => 'valerie-rv.jpg',
                'date' => 'Samedi 12 au 15 mai 2021 de 8h30 à 17h',
                'title' => 'LABORE ET DOLORE',
                'text' => 'Sed do eiusmod tempor incididunt ut labore et doloremagna aliqua. Ut enim ad minim veniam, quisnostrud exercitation ullamco laboris nisi ut'
            ]
        ];

        $content['list'] = $paginator->paginate(
            $rendezVousData, // Requête contenant les données à paginer
            $request->query->getInt('page', 1), // Numéro de la page demandée via url, 1 si aucune page
            2 // le nombre d'articles par page
        );

        return $this->render('blog-content/index.html.twig', [
            'heroImgName' => $this->heroImgName,
            'navbarInfos' => $navbarInfos,
            'navigationInfos' => $navigationInfos,
            'contentNavigation' => $contentNavigation,
            'content' => $content
        ]);
    }
}
