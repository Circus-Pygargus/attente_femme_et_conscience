<?php

namespace App\Controller;

use App\Repository\Traits\AccompanimentAndFormationTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccompanimentAndFormationController extends AbstractController
{
    use AccompanimentAndFormationTrait;

    /**
     * @Route("/accompaniments-and-formations", name="accompaniments_and_formations")
     */
    public function list () : Response
    {
        $accompAndFormLinks = $this->getLinks();
        $navbarInfos = [
            'page' => 'accompaniment-and-formation'
        ];
        $navigationInfos = [
            [
                'text' => 'Accueil',
                'urlPath' => 'home'
            ],
            [
                'text' => 'Accompagnements & Formations',
                'urlPath' => 'accompaniments_and_formations'
            ]
        ];
        $accompAndFormlist = [];

        return $this->render('accompaniment-and-formation/detail.html.twig', [
            'accompAndFormLinks' => $accompAndFormLinks,
            'navbarInfos' => $navbarInfos,
            'navigationInfos' => $navigationInfos,
            'accompAndFormlist' => $accompAndFormlist
        ]);
    }

    /**
     * @Route("/accompaniments-and-formations/presential", name="accompaniment_and_formations_presential")
     */
    public function presentialList (): JsonResponse
    {
        return new JsonResponse();
    }

    /**
     * @Route("/accompaniments-and-formations/{slug}", name="accompaniments_and_formations_showone", methods={"GET"})
     */
    public function showOne (string $slug) : Response
    {
        $accompAndFormDetails = [
            'slug' => 2,
            'category' => 'Accompagnement en présentiel',
            'title' => 'à la découverte de mon corps de femme et de ma sensualité',
            'text' => "Dans ce que l’on peut voir, entendre ou lire concernant les Femmes actuellement, nous avons en tant que Femme notre responsabilité.\nNous pouvons chacune à notre niveau être actrice du changement.\n\nPour paraphraser la citation de Gandhi :\n“Femmes, soyez le changement que vous voulez voir dans ce monde !”\n\nLa Bienveillance comment d’abord par nous-même.\nEt elle est aussi à l’égard des autres Femmes.",
            'reservationLlink' => "#"
        ];
        $accompAndFormLinks = $this->getLinks();
        $navbarInfos = [
            'page' => 'accompaniment-and-formation'
        ];
        $navigationInfos = [
            [
                'text' => 'Accueil',
                'urlPath' => 'home'
            ],
            [
                'text' => 'Accompagnements & Formations',
                'urlPath' => 'accompaniments_and_formations'
            ],
            [
                'text' => $accompAndFormDetails['title'],
                'urlPath' => 'accompaniments_and_formations_showone',
                'slug' => $accompAndFormDetails['slug']
            ]
        ];

        return $this->render('accompaniment-and-formation/detail.html.twig', [
            'accompAndFormLinks' => $accompAndFormLinks,
            'navbarInfos' => $navbarInfos,
            'navigationInfos' => $navigationInfos,
            'accompAndFormDetails' => $accompAndFormDetails
        ]);
    }
}
