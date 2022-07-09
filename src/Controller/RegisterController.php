<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\Customer;
use App\Form\CustomerType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function registerAction(Request $req,
    UserPasswordHasherInterface $hasher, ManagerRegistry $reg): Response
    {
        $user = new Customer();
        $cart = new Cart();
        
        $form = $this->createForm(CustomerType::class, $user);
        $form->handleRequest($req);

        $entity = $reg->getManager();
        
        if($form->isSubmitted() && $form->isValid()){
            $user->setPassword($hasher->hashPassword($user, $form->get('password')->getData()));
            $user->setRoles(['ROLE_USER']);

            $entity->persist($user);
            $entity->flush();

            $cart->setUsername($user);

            $entity->persist($cart);
            $entity->flush();
            
            return $this->redirectToRoute('app_home_page');
        }

        return $this->render('register/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
