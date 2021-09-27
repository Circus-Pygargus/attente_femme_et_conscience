<?php

namespace App\Controller\Security;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ArticleController
 * @package App\Controller\Account
 * @Route("/mon-compte", name="account_")
 */
class AccountController extends AbstractController
{
    private string $heroImgName;
    private array $navigationInfos;
    private array $contentNavigation;

    public function __construct()
    {
        $this->heroImgName = 'green-mountains.jpg';
        $this->navigationInfos = [
            [
                'text' => 'Accueil',
                'urlPath' => 'home'
            ],
            [
                'text' => 'Mon compte utilisateur',
                'urlPath' => 'account_base'
            ]
        ];
        $this->contentNavigation = [
            'title' => 'Mon Compte',
            'specialLinks' => [
                [
                    'label' => 'Mes réservations',
                'urlPath' => 'account_reservation'
                ],
                [
                    'label' => 'Mes abonnements',
                    'urlPath' => 'account_subscription'
                ],
                [
                    'label' => 'Mes informations',
                    'urlPath' => 'account_informations'
                ],
                [
                    'label' => 'Déconnexion',
                    'urlPath' => 'account_disconnect'
                ]
            ]
        ];
    }

    /**
     * @Route("/", name="base")
     */
    public function index (): Response
    {
        $this->contentNavigation['inUseRegex'] = 'account_base';

        return $this->render('account/index.html.twig', [
            'heroImgName' => $this->heroImgName,
            'navigationInfos' => $this->navigationInfos,
            'contentNavigation' => $this->contentNavigation
        ]);
    }

    /**
     * @Route("/reservations", name="reservation")
     */
    public function reservation (): Response
    {
        $this->contentNavigation['inUseRegex'] = 'account_reservation';
        $this->navigationInfos[] = [
            'text' => 'Mes réservations',
            'urlPath' => 'account_reservation'
        ];

        return $this->render('account/reservation.html.twig', [
            'heroImgName' => $this->heroImgName,
            'navigationInfos' => $this->navigationInfos,
            'contentNavigation' => $this->contentNavigation
        ]);
    }

    /**
     * @Route("/abonnements", name="subscription")
     */
    public function subscription (): Response
    {
        $this->contentNavigation['inUseRegex'] = 'account_subscription';
        $this->navigationInfos[] = [
            'text' => 'Mes abonnements',
            'urlPath' => 'account_subscription'
        ];

        return $this->render('account/subscription.html.twig', [
            'heroImgName' => $this->heroImgName,
            'navigationInfos' => $this->navigationInfos,
            'contentNavigation' => $this->contentNavigation
        ]);
    }

    /**
     * @Route("/informations", name="informations")
     */
    public function informations (): Response
    {
        $this->contentNavigation['inUseRegex'] = 'account_informations';
        $this->navigationInfos[] = [
            'text' => 'Mes abonnements',
            'urlPath' => 'account_informations'
        ];

        return $this->render('account/informations.html.twig', [
            'heroImgName' => $this->heroImgName,
            'navigationInfos' => $this->navigationInfos,
            'contentNavigation' => $this->contentNavigation
        ]);
    }

    /**
     * @Route("/deconnexion", name="disconnect")
     */
    public function disconnect (): Response
    {
        $this->contentNavigation['inUseRegex'] = 'account_disconnect';
        $this->navigationInfos[] = [
            'text' => 'Mes abonnements',
            'urlPath' => 'account_disconnect'
        ];

        return $this->render('account/disconnect.html.twig', [
            'heroImgName' => $this->heroImgName,
            'navigationInfos' => $this->navigationInfos,
            'contentNavigation' => $this->contentNavigation
        ]);
    }
}
