<?php

namespace App\Controller\Admin;

use App\Entity\RendezVous;
use App\Form\RendezVous\AddRendezVousFormType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class RendezVousController
 * @package App\Controller\Admin
 * @Route("/admin/rendez-vous", name="admin_rendez_vous_")
 */
class RendezVousController extends AdminController
{
    public function __construct ()
    {
        parent::__construct();

        $this->contentNavigation['inUseRegex'] = 'admin_rendez_vous';
        $this->navigationInfos[] = [
            'text' => 'Gérer les rendez-vous',
            'urlPath' => 'admin_rendez_vous_list'
        ];
    }

    /**
     * @Route("/", name="list")
     */
    public function list (): Response
    {
        return new Response();
    }

    /**
     * @Route("/nouveau", name="create")
     */
    public function create (Request $request): Response
    {
        $this->navigationInfos[] = [
            'text' => 'Créer un rendez-vous',
            'urlPath' => 'admin_rendez_vous_create'
        ];

        $rendezVous = new RendezVous();

        $form = $this->createForm(AddRendezVousFormType::class, $rendezVous);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rendezVous->setPublished(false);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($rendezVous);
            $entityManager->flush();

            return $this->redirectToRoute('admin_rendez_vous_list');
        }

        return $this->render('admin/rendez-vous/create.html.twig', [
            'heroImgName' => $this->heroImgName,
            'navigationInfos' => $this->navigationInfos,
            'contentNavigation' => $this->contentNavigation,
            'rendezVousForm' => $form->createView()
        ]);
    }
}
