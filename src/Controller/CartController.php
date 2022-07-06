<?php

namespace App\Controller;

use App\Entity\CartDetail;
use App\Entity\Customer;
use App\Entity\Product;
use App\Repository\CartDetailRepository;
use App\Repository\CartRepository;
use App\Repository\ProductRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/cart/{id}", name="app_cart")
     */
    public function index(CartRepository $repo, $id, ManagerRegistry $reg, ProductRepository $prorepo): Response
    {
        $cartDetail = new CartDetail();
        $user = $this->getUser();

        $pro = $prorepo->find($id);
        $cart = $repo->findOneBy(['username' => $user]);

        $cartDetail->setCart($cart);
        $cartDetail->setProduct($pro);
        $cartDetail->setQuantity(1);

        $entity = $reg->getManager();

        $entity->persist($cartDetail);
        $entity->flush();

        return $this->redirectToRoute('app_show_cart');
    }
    /**
     * @Route("/cart", name="app_show_cart")
     */
    public function showcartAction(CartDetailRepository $repo): Response
    {
        $showcart = $repo->findAll();
        return $this->render('cart/index.html.twig', [
            'cart'=> $showcart
        ]);
    }
}
