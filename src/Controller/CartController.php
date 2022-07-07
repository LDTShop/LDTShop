<?php

namespace App\Controller;

use App\Entity\CartDetail;
use App\Entity\Customer;
use App\Entity\Product;
use App\Repository\CartDetailRepository;
use App\Repository\CartRepository;
use App\Repository\OrdersDetailRepository;
use App\Repository\ProductRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="app_cart_page")
     */
    public function indexCart(): Response
    {
        return $this->redirectToRoute('app_login');
    }
    /**
     * @Route("/cart/{username}", name="app_show_cart")
     */
    public function showcartAction(CartDetailRepository $crepo, Customer $user, ProductRepository $repo): Response
    {
        $user = $this->getUser();

        if(!$user){
            return $this->redirectToRoute('app_login');
        }else{
            $showcart = $repo->findByCartUser($user);
            return $this->render('cart/index.html.twig', [
            'cart'=> $showcart,
            'customer'=>$user
            ]);
            // return $this->json($showcart);
        }
    }
    
    /**
     * @Route("/cart/{id}/add", name="app_cart")
     */
    public function index(CartRepository $repo, $id, ManagerRegistry $reg, 
    ProductRepository $prorepo, CartDetailRepository $cartDetailrepo): Response
    {
        $cartDetail = new CartDetail();
        $user = $this->getUser();

        $pro = $prorepo->find($id);
        $cart = $repo->findOneBy(['username' => $user]);

        $entity = $reg->getManager();

        $cartd = $cartDetailrepo->checkQuantity($id, $cart);

        if($cartd[0]['count'] == 0){
            $cartDetail->setCart($cart);
            $cartDetail->setProduct($pro);
            $cartDetail->setQuantity(1);
    
            $entity->persist($cartDetail);
            $entity->flush();

            $this->addFlash(
                'info',
                'Add to cart successfully!'
            );
        }else{
            $quantity = $cartd[0]['quantity'] + 1;
            $cartdId = $cartd[0]['id'];

            $cartDetail = $cartDetailrepo->find($cartdId);
            $cartDetail->setQuantity($quantity);

            $entity->persist($cartDetail);
            $entity->flush();

            $this->addFlash(
                'info',
                'Add to cart successfully!'
            );
        }
        return $this->redirectToRoute('app_home_page');
    }

    /**
     * @Route("/cart/delete/{id}", name="app_cart_delete")
     */
    public function delete($id, CartDetailRepository $repo, ManagerRegistry $reg): Response
    {
        $entity = $reg->getManager();
        $cartd = $repo->find($id);

        $entity->remove($cartd);
        $entity->flush();

        return $this->redirectToRoute('app_home_page');
    }
}
