<?php

namespace App\Controller\Admin;

use App\Entity\PresentialAccompaniment;
use App\Form\PresentialAccompaniment\AddPresentialAccompanimentFormType;
use App\Form\PresentialAccompaniment\PublishPresentialAccompanimentFormType;
use App\Repository\PresentialAccompanimentRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PresentialAccompanimentController
 * @package App\Controller\Admin
 * @Route("/admin/accompagnement-en-presentiel", name="admin_presential_accompaniments_")
 */
class PresentialAccompanimentController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->contentNavigation['inUseRegex'] = 'admin_presential_accompaniments';
        $this->navigationInfos[] = [
            'text' => 'Gérer les accompagnement en présentiel',
            'urlPath' => 'admin_presential_accompaniments_list'
        ];
    }

    /**
     * @Route("/", name="list")
     */
    public function list (
        Request $request,
        PresentialAccompanimentRepository $presentialAccompanimentRepository,
        PaginatorInterface $paginator
    ): Response
    {
        $this->navigationInfos[] = [
            'text' => 'Gérer les accompagnements en présentiel',
            'urlPath' => 'admin_presential_accompaniments_list'
        ];

        // Pour les formulaires de publication ou de suppression de recette
        // un seul formulaire de chaque, géré en js
        $message = '';
        $presentialAccompaniment = new PresentialAccompaniment();
        $publishForm = $this->createForm(PublishPresentialAccompanimentFormType::class, $presentialAccompaniment);

        $publishForm->handleRequest($request);

        if ($publishForm->isSubmitted() && $publishForm->isValid()) {
            $newInfosPresentialAccompaniment = $publishForm->getData();
            $presentialAccompaniment = $presentialAccompanimentRepository->findOneBy(['slug' => $newInfosPresentialAccompaniment->getSlug()]);
            $presentialAccompaniment->setPublished($newInfosPresentialAccompaniment->getPublished());
            $doctrine = $this->getDoctrine()->getManager();
            $doctrine->persist($presentialAccompaniment);
            $doctrine->flush();

            if ($presentialAccompaniment->getPublished()) {
                $message = 'L\'accompagnement en présentiel <b>' . $presentialAccompaniment->getTitle() . '</b> est maintenant publié.';
            } else {
                $message = 'L\'accompagnement en présentiel <b>' . $presentialAccompaniment->getTitle() . '</b> n\'est plus publié.';
            }
        }

        // Pour la liste des recettes
        $presentialAccompanimentData = $presentialAccompanimentRepository->getPresentialAccompanimentsAdminList();

        $presentialAccompaniments = $paginator->paginate(
            $presentialAccompanimentData, // Requête contenant les données à paginer
            $request->query->getInt('page', 1), // Numéro de la page demandée via url, 1 si aucune page
            2 // le nombre d'articles par page
        );

        return $this->render('admin/presential-accompaniment/list.html.twig', [
            'heroImgName' => $this->heroImgName,
            'navigationInfos' => $this->navigationInfos,
            'contentNavigation' => $this->contentNavigation,
            'presentialAccompanimentPublishForm' => $publishForm->createView(),
            'lastPresentialAccompanimentMessage' => $message,
            'presentialAccompaniments' => $presentialAccompaniments
        ]);
    }

    /**
     * @Route("/nouvel", name="create")
     */
    public function create (Request $request): Response
    {
        $this->navigationInfos[] = [
            'text' => 'Créer un accompagnement en présentiel',
            'urlPath' => 'admin_presential_accompaniments_create'
        ];

        $presentialAccompaniment = new PresentialAccompaniment();

        $form = $this->createForm(AddPresentialAccompanimentFormType::class, $presentialAccompaniment);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $presentialAccompaniment->setPublished(false);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($presentialAccompaniment);
            $entityManager->flush();

            return $this->redirectToRoute('admin_presential_accompaniments_list');
        }

        return $this->render('admin/presential-accompaniment/create.html.twig', [
            'heroImgName' => $this->heroImgName,
            'navigationInfos' => $this->navigationInfos,
            'contentNavigation' => $this->contentNavigation,
            'presentialAccompanimentForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/edite/{slug}", name="edit")
     */
    public function edit ():Response
    {
        return new Response();
    }
}
