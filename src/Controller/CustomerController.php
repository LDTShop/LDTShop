<?php

namespace App\Controller;

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
}
