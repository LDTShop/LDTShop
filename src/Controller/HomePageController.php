<?php

namespace App\Controller;

use App\Form\ChangePassType;
use App\Repository\CustomerRepository;
use App\Repository\ProductRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
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
     * @Route("/change", name="app_change_pass")
     */
    public function changeAction(CustomerRepository $repo, Request $req, 
    ManagerRegistry $reg, UserPasswordHasherInterface $hasher): Response
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $user->getId();
        $user = $repo->find($user);
        $form = $this->createForm(ChangePassType::class, $user);
        $form->handleRequest($req);
        $entity = $reg->getManager();
        
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($hasher->hashPassword($user, $form->get('password')->getData()));
            $entity->persist($user);
            $entity->flush();

            return $this->redirectToRoute('app_home_page');
        };
        return $this->render('home_page/change.html.twig',[
            'form'=>$form->createView()
        ]);
    }
    /**
     * @Route("/temp", name="temp", methods={"POST"})
     */
    public function tempAction(Request $req, UserPasswordHasherInterface $hasher, 
    CustomerRepository $repo, ManagerRegistry $reg): Response
    {
        $user = $this->getUser();
        $oldpass = $req->request->get('password');
        $a = $hasher->isPasswordValid($user,$oldpass);

        if($a == true){
            return $this->redirectToRoute('app_change_pass');
        }else{
            return new Response('Invalid Pass');
        }

        // return $this->render('home_page/confirmpass.html.twig');    
    }
    /**
     * @Route("/comfirmpass", name="comfirmpass")
     */
    public function comfirmpass(): Response
    {
        return $this->render('home_page/temp.html.twig', []);
    }
}
