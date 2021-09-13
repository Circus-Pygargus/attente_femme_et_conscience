<?php

namespace App\Controller\Admin;

use App\Entity\RendezVous;
use App\Form\RendezVous\AddRendezVousFormType;
use App\Form\RendezVous\PublishRendezVousFormType;
use App\Repository\RendezVousRepository;
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
    public function list (
        Request $request,
        RendezVousRepository $rendezVousRepository,
        PaginatorInterface $paginator
    ): Response
    {
        $this->navigationInfos[] = [
            'text' => 'Gérer les rendez-vous',
            'urlPath' => 'admin_rendez_vous_list'
        ];

        // Pour les formulaires de publication ou de suppression de recette
        // un seul formulaire de chaque, géré en js
        $message = '';
        $rendezVous = new RendezVous();
        $publishForm = $this->createForm(PublishRendezVousFormType::class, $rendezVous);

        $publishForm->handleRequest($request);

        if ($publishForm->isSubmitted() && $publishForm->isValid()) {
            $newInfosRendezVousData = $publishForm->getData();
            $rendezVous = $rendezVousRepository->findOneBy(['slug' => $newInfosRendezVousData->getSlug()]);
            $rendezVous->setPublished($newInfosRendezVousData->getPublished());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($rendezVous);
            $entityManager->flush();

            if ($rendezVous->getPublished()) {
                $message = 'Le rendez-vous <b>' . $rendezVous->getTitle() . '</b> est maintenant publié.';
            } else {
                $message = 'Le rendez-vous <b>' . $rendezVous->getTitle() . '</b> n\'est plus publié.';
            }
        }

        // Pour la liste des recettes
        $rendezVousData = $rendezVousRepository->getRendezVousListForAdmin();

        $allRendezVous = $paginator->paginate(
            $rendezVousData, // Requête contenant les données à paginer
            $request->query->getInt('page', 1), // Numéro de la page demandée via url, 1 si aucune page
            2 // le nombre d'articles par page
        );

        return $this->render('admin/rendez-vous/list.html.twig', [
            'heroImgName' => $this->heroImgName,
            'navigationInfos' => $this->navigationInfos,
            'contentNavigation' => $this->contentNavigation,
            'rendezVousPublishForm' => $publishForm->createView(),
            'lastRendezVousMessage' => $message,
            'allRendezVous' => $allRendezVous
        ]);
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

    /**
     * @Route("/edite/{slug}", name="edit")
     */
    public function edit (string $slug): Response
    {
        return new Response();
    }
}
