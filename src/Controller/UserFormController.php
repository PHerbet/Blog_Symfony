<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\UserType;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class UserFormController extends AbstractController
{
    #[Route('/user/form', name: 'app_user_form')]
    public function index(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        //instanciation d'un nouvel objet User 
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            //faire persister les données
            $entityManagerInterface->persist($user);
            //envoit en bdd
            $entityManagerInterface->flush();
            return $this->redirectToRoute('app_user_form');
        }

        return $this->render('user_form/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

