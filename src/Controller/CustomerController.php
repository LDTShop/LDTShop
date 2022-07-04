<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Repository\CustomerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CustomerController extends AbstractController
{
    /**
     * @Route("/customer", name="app_customer")
     */
    public function index(CustomerRepository $repo): Response
    {
        return $this->render('customer/index.html.twig', [
            'customers' =>$repo-> findAll(),
        ]);
    }
    /**
     * @Route("/customer/account/{username}", name="app_customer_account", methods={"GET"})
     */
    public function cusAccountAction(Customer $customer): Response
    {
        $customer = $this->getUser();
        return $this->render('customer/show.html.twig', [
            'customer'=>$customer
        ]);
    }
}
