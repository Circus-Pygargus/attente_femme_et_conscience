<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AdminController;
use App\Entity\Product;
use App\Form\Product\AddProductFormType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ProductController
 * @package App\Controller\Admin
 * @Route("/gestion/produits", name="admin_products_")
 */
class ProductController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->contentNavigation['inUseRegex'] = 'admin_products';
        $this->navigationInfos[] = [
            'text' => 'Gérer les produits',
            'urlPath' => 'admin_products_list'
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
            'text' => 'Créer un produit',
            'urlPath' => 'admin_products_create'
        ];

        $product = new Product();

        $form = $this->createForm(AddProductFormType::class, $product);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('admin_products_list');
        }

        return $this->render('admin/product/create.html.twig', [
            'heroImgName' => $this->heroImgName,
            'navigationInfos' => $this->navigationInfos,
            'contentNavigation' => $this->contentNavigation,
            'productForm' => $form->createView()
        ]);
    }
}
