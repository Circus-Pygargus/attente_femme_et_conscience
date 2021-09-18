<?php

namespace App\Controller\Admin;

use App\Entity\Newsletter;
use App\Form\Newsletter\AddNewsletterFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class NewsletterController
 * @package App\Controller\Admin
 * @Route("/admin/newsletter", name="admin_newsletters_")
 */
class NewsletterController extends AdminController
{
    public function __construct()
    {
        parent::__construct();

        $this->contentNavigation['inUseRegex'] = 'admin_newsletter';
        $this->navigationInfos[] = [
            'text' => 'Gérer les newsletters',
            'urlPath' => 'admin_newsletters_list'
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
     * @Route("/nouvelle", "create")
     */
    public function create (Request $request): Response
    {
        $newsletter = new Newsletter();

        $form = $this->createForm(AddNewsletterFormType::class, $newsletter);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($newsletter);
            $em->flush();
        }

        return $this->render('admin/newsletter/create.html.twig', [
            'heroImgName' => $this->heroImgName,
            'navigationInfos' => $this->navigationInfos,
            'contentNavigation' => $this->contentNavigation,
            'newsletterForm' => $form->createView()
        ]);
    }
}
