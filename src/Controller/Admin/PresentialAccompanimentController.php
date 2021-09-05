<?php

namespace App\Controller\Admin;

use App\Entity\PresentialAccompaniment;
use App\Form\PresentialAccompaniment\AddPresentialAccompanimentFormType;
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
    public function list (): Response
    {
        return new Response();
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
}
