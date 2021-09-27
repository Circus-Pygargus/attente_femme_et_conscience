<?php

namespace App\Controller\Admin;

use App\Entity\Newsletter;
use App\Form\Newsletter\AddNewsletterFormType;
use App\Form\Newsletter\SendNewsletterFormType;
use App\Repository\NewsletterRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class NewsletterController
 * @package App\Controller\Admin
 * @Route("/admin/newsletters", name="admin_newsletters_")
 */
class NewsletterController extends AdminController
{
    public function __construct()
    {
        parent::__construct();

        $this->contentNavigation['inUseRegex'] = 'admin_newsletters';
        $this->navigationInfos[] = [
            'text' => 'Gérer les newsletters',
            'urlPath' => 'admin_newsletters_list'
        ];
    }

    /**
     * @Route("/", name="list")
     */
    public function list (
        Request $request,
        NewsletterRepository $newsletterRepository,
        PaginatorInterface $paginator
    ): Response
    {
        // un seul formulaire pour l'envoi de newsletter gér~en js
        $message = '';
        $newsletter = new Newsletter();
        $sendForm = $this->createForm(SendNewsletterFormType::class, $newsletter);

        $sendForm->handleRequest($request);

        if ($sendForm->isSubmitted() && $sendForm->isValid()) {
            $newInfosNewsletterData = $sendForm->getData();
            $newsletter = $newsletterRepository->findOneBy(['slug' => $newInfosNewsletterData->getSlug()]);
            $newsletter->setIsSent($newInfosNewsletterData->getIsSent());
            $em = $this->getDoctrine()->getManager();
            $em->persist($newsletter);
            $em->flush();

            if ($newsletter->getIsSent()) {
                $message = 'La newswletter <b>' . $newsletter->getTitle() . '</b> est maintenant envoyée.';
            }
        }

        // liste des newsletters
        $newsletterData = $newsletterRepository->getNewslettersListForAdmin();

        $allNewsletters = $paginator->paginate(
            $newsletterData, // Requête contenant les données à paginer
            $request->query->getInt('page', 1), // Numéro de la page demandée via url, 1 si aucune page demandée
            2 // le nombre de newsletters par page
        );

        return $this->render('admin/newsletter/list.html.twig', [
            'heroImgName' => $this->heroImgName,
            'navigationInfos' => $this->navigationInfos,
            'contentNavigation' => $this->contentNavigation,
            'newsletterIsSentForm' => $sendForm->createView(),
            'lastNewsletterMessage' => $message,
            'allNewsletters' => $allNewsletters
        ]);
    }

    /**
     * @Route("/nouvelle", name="create")
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

            return $this->redirectToRoute('admin_newsletters_list');
        }

        return $this->render('admin/newsletter/create.html.twig', [
            'heroImgName' => $this->heroImgName,
            'navigationInfos' => $this->navigationInfos,
            'contentNavigation' => $this->contentNavigation,
            'newsletterForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/edite/{slug}", name="edit")
     */
    public function edit (
        string $slug,
        Request $request,
        NewsletterRepository $newsletterRepository
    ): Response
    {
        $this->navigationInfos[] = [
            'text' => 'Éditer une newsletter',
            'urlPath' => 'admin_newsletters_edit',
            'slug' => $slug
        ];

        if ($slug !== '') {
            $newsletter = $newsletterRepository->findOneBy(['slug' => $slug]);
        } else {
            dd('étrange');
            $newsletter = new Newsletter();
        }

        $form = $this->createForm(AddNewsletterFormType::class, $newsletter);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($newsletter);
            $em->flush();

            return $this->redirectToRoute('admin_newsletters_list');
        }

        return $this->render('admin/newsletter/edit.html.twig', [
            'heroImgName' => $this->heroImgName,
            'navigationInfos' => $this->navigationInfos,
            'contentNavigation' => $this->contentNavigation,
            'newsletterForm' => $form->createView()
        ]);
    }
}
