<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RawAndLivingFoodController extends AbstractController
{
    /**
     * @Route("/alimentation-crue-et-vivante", name="raw_and_living_food")
     */
    public function index (): Response
    {
        $navbarInfos = [
            'page' => 'raw-and-living-food'
        ];
        $navigationInfos = [
            [
                'text' => 'Accueil',
                'urlPath' => 'home'
            ],
            [
                'text' => 'Alimentation crue et vivante',
                'urlPath' => 'raw_and_living_food'
            ]
        ];
        return $this->render('raw-and-living-food/index.html.twig', [
            'navbarInfos' => $navbarInfos,
            'navigationInfos' => $navigationInfos
        ]);
    }
}
