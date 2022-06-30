<?php

namespace App\Controller;
use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    /**
     * @Route("/", name="app_home_page")
     */
    public function indexHomePage(ProductRepository $productRepository): Response
    {
        return $this->render('home_page/index.html.twig', [
            'products' => $productRepository->findAll(),
        ]);
    }

     /**
     * @Route("/{id}", name="detailProduct", methods={"GET"})
     */
    public function FunctionName(Product $product): Response
    {
        return $this->render('product/detail.html.twig', [
            'product' => $product,
        ]);
    }
}
