<?php

namespace App\Controller;

use App\Entity\Orders;
use App\Entity\OrdersDetail;
use App\Repository\CartDetailRepository;
use App\Repository\CartRepository;
use App\Repository\CustomerRepository;
use App\Repository\OrdersRepository;
use App\Repository\ProductRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrdersController extends AbstractController
{
    /**
     * @Route("/orders/add", name="app_orders_add")
     */
    public function addOrderAction(ManagerRegistry $reg, CartRepository $cartRepo,
    CustomerRepository $cusRepo, CartDetailRepository $cartDRepo, 
    OrdersRepository $orderRepo, ProductRepository $proRepo): Response
    {
        $order = new Orders();
        $user = $this->getUser();
        $entity = $reg->getManager();
        $cart = $cartRepo->findOneBy(['username'=>$user]);

        $curDate = new \DateTime();
        $curDate->format('H:i:s \O\n d-m-Y');

        $getCart = $cartRepo->totalPrice($user);
        $get = $cusRepo->getInfoCus($user);

        $address = $get[0]['address'];
        // $cusName = $get[0]['cusName'];
        // $customer = $get[0]['Customer'];

        $order->setOrderDate($curDate);
        $order->setPayment($getCart[0]['total']);
        $order->setAddress($address);
        $order->setUsername($user);
        $order->setStatus("Packing");

        $entity->persist($order);
        $entity->flush();

        //add to orders detail
        $cartD = $cartDRepo->countCartDetail($cart);
        $get = $cartD[0]['countCD'];
        $orderId = $orderRepo->getOrderId($user);
        $getOrder = $orderId[0]['OrderId'];

        $orders = $orderRepo->find($getOrder);

        if($get != 0){
            for($i = 0; $i < $get; $i++){
                $orderD = new OrdersDetail();

                $getCart = $cartDRepo->getProductID($cart);

                $quantity = $getCart[$i]['quantity'];
                $proId = $getCart[$i]['product'];
                $price = $getCart[$i]['price'];
                $total = $getCart[$i]['total'];

                $products = $proRepo->find($proId);

                $orderD->setProQuantity($quantity);
                $orderD->setOrderId($orders);
                $orderD->setProductId($products);
                $orderD->setPrice($price);
                $orderD->setTotal($total);

                $entity->persist($orderD);
                $entity->flush();
            }
        }else{
            return new Response("No product to order");
        }
        return $this->redirectToRoute('app_home_page');
    }
    /**
     * @Route("/test", name="RouteName")
     */
    public function FunctionName(CartRepository $repo, CartDetailRepository $carepo): Response
    {
        $user = $this->getUser();
        $cart = $repo->findOneBy(['username'=>$user]);
        $test = $carepo->countCartDetail($cart);
        $n = $test[0]['countCD'];
        return $this->json($n);
    }
}
