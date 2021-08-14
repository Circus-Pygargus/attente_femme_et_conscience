<?php

namespace App\Controller;

use App\Repository\Traits\RecipeTrait;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RawAndLivingFoodController extends AbstractController
{
    use RecipeTrait;

    /**
     * @Route("/alimentation-crue-et-vivante", name="raw_and_living_food")
     */
    public function index (EntityManagerInterface $entityManager): Response
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
        $contentNavigation = $this->getRecipesAndRelatedLinks($entityManager);
        $contentNavigation['inUseRegex'] = 'raw_and_living_food';
        $content['page'] = 'Présentation';


        return $this->render('raw-and-living-food/index.html.twig', [
            'navbarInfos' => $navbarInfos,
            'navigationInfos' => $navigationInfos,
            'contentNavigation' => $contentNavigation,
            'content' => $content
        ]);
    }
}
