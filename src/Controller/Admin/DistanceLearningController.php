<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AdminController;
use App\Entity\DistanceLearning;
use App\Form\DistanceLearning\AddDistanceLearningFormType;
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
    public function list (): Response
    {
        return new Response();
    }

    /**
     * @Route("/nouvelle", name="create")
     */
    public function create (Request $request): Response
    {
        $this->navigationInfos[] = [
            'text' => 'Gérer les recettes',
            'urlPath' => 'admin_distance_learnings_list'
        ];
        $this->navigationInfos[] = [
            'text' => 'Créer une recette',
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
}
