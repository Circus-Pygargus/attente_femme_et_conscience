<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AdminController;
use App\Entity\DistanceLearning;
use App\Form\DistanceLearning\AddDistanceLearningFormType;
use App\Form\DistanceLearning\EditDistanceLearningFormType;
use App\Form\DistanceLearning\PublishDistanceLearningFormType;
use App\Repository\DistanceLearningRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DistanceLearningController
 * @package App\Controller\Admin
 * @Route("/admin/formations-a-distance", name="admin_distance_learnings_")
 */

class DistanceLearningController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->contentNavigation['inUseRegex'] = 'admin_distance_learnings';
    }

    /**
     * @Route("/", name="list")
     */
    public function list (
        Request $request,
        DistanceLearningRepository $distanceLearningRepository,
        PaginatorInterface $paginator
    ): Response
    {
        $this->navigationInfos[] = [
            'text' => 'Gérer les formations à distance',
            'urlPath' => 'admin_distance_learnings_list'
        ];

        // Pour les formulaires de publication ou de suppression de recette
        // un seul formulaire de chaque, géré en js
        $message = '';
        $distanceLearning = new DistanceLearning();
        $publishForm = $this->createForm(PublishDistanceLearningFormType::class, $distanceLearning);

        $publishForm->handleRequest($request);

        if ($publishForm->isSubmitted() && $publishForm->isValid()) {
            $newInfosDistanceLearning = $publishForm->getData();
            $distanceLearning = $distanceLearningRepository->findOneBy(['slug' => $newInfosDistanceLearning->getSlug()]);
            $distanceLearning->setPublished($newInfosDistanceLearning->getPublished());
            $doctrine = $this->getDoctrine()->getManager();
            $doctrine->persist($distanceLearning);
            $doctrine->flush();

            if ($distanceLearning->getPublished()) {
                $message = 'La formation à distance <b>' . $distanceLearning->getTitle() . '</b> est maintenant publiée.';
            } else {
                $message = 'La formation à distance <b>' . $distanceLearning->getTitle() . '</b> n\'est plus publiée.';
            }
        }

        // Pour la liste des recettes
        $distanceLearningData = $distanceLearningRepository->getDistanceLearningsAdminList();

        $distanceLearnings = $paginator->paginate(
            $distanceLearningData, // Requête contenant les données à paginer
            $request->query->getInt('page', 1), // Numéro de la page demandée via url, 1 si aucune page
            2 // le nombre d'articles par page
        );

        return $this->render('admin/distance-learning/list.html.twig', [
            'heroImgName' => $this->heroImgName,
            'navigationInfos' => $this->navigationInfos,
            'contentNavigation' => $this->contentNavigation,
            'distanceLearningPublishForm' => $publishForm->createView(),
            'lastDistanceLearningMessage' => $message,
            'distanceLearnings' => $distanceLearnings
        ]);
    }

    /**
     * @Route("/nouvelle", name="create")
     */
    public function create (Request $request): Response
    {
        $this->navigationInfos[] = [
            'text' => 'Gérer les formations à distance',
            'urlPath' => 'admin_distance_learnings_list'
        ];
        $this->navigationInfos[] = [
            'text' => 'Créer une formation à distance',
            'urlPath' => 'admin_distance_learnings_create'
        ];

        $distanceLearning = new DistanceLearning();

        $form = $this->createForm(AddDistanceLearningFormType::class, $distanceLearning);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $distanceLearning->setPublished(false);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($distanceLearning);
            $entityManager->flush();

            return $this->redirectToRoute('admin_distance_learnings_list');
        }

        return $this->render('admin/distance-learning/create.html.twig', [
            'heroImgName' => $this->heroImgName,
            'navigationInfos' => $this->navigationInfos,
            'contentNavigation' => $this->contentNavigation,
            'distanceLearningForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/edite/{slug}", name="edit")
     */
    public function edit (
        string $slug = '',
        Request $request,
        DistanceLearningRepository $distanceLearningRepository
    ):Response
    {
        $this->navigationInfos[] = [
            'text' => 'Gérer les formations à distance',
            'urlPath' => 'admin_distance_learnings_list'
        ];
        $this->navigationInfos[] = [
            'text' => 'Éditer une formation à distance',
            'urlPath' => 'admin_distance_learnings_edit'
        ];

        if ($slug != '') {
            $distanceLearning = $distanceLearningRepository->findOneBy(['slug' => $slug]);
        } else {
            dd('Etrange');
            $distanceLearning = new DistanceLearning();
        }

        $form = $this->createForm(EditDistanceLearningFormType::class, $distanceLearning);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($distanceLearning);
            $em->flush();

            return $this->redirectToRoute('admin_distance_learnings_list');
        }

        return $this->render('admin/distance-learning/edit.html.twig', [
            'heroImgName' => $this->heroImgName,
            'navigationInfos' => $this->navigationInfos,
            'contentNavigation' => $this->contentNavigation,
            'distanceLearningForm' => $form->createView()
        ]);
    }
}
