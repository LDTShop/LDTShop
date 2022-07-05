<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Form\CustomerUserType;
use App\Repository\CustomerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    
    /**
     * @Route("/customer/account/{username}/edit", name="app_customer_account_edit", methods={"GET", "POST"})
     */
    public function FunctionName(Request $req, CustomerRepository $repo ,Customer $customer): Response
    {
        $form = $this->createForm(CustomerUserType::class, $customer);
        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {
            $repo->add($customer, true);

            return $this->redirectToRoute('app_home_page', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('customer/edit.html.twig', [
            'form' => $form,
        ]);
    }
}
