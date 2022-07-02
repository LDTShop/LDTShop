<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search_product", methods={"GET"})
     */
    public function searchAction(ProductRepository $repo, Request $req): Response
    {
        $mess = $req->query->get('search');
        $product = $repo->findBySearchProduct($mess);
        return $this->render('search/index.html.twig', [
            'search'=>$product
        ]);
        // return $this->json($product);
    }
}
