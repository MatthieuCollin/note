<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Form\ModifyUserType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $userRepository = $entityManager->getRepository(User::class);
        $users = $userRepository->findAll();

        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'users' => $users
        ]);
    }

    #[Route('/admin-modification', name: 'app_admin-modif')]
    public function modifUser(Request $request,EntityManagerInterface $entityManager,ManagerRegistry $doctrine, UserPasswordHasherInterface $encoder): Response
    {

        // on génere une nouvelle class User
        $user = new User();

        // on génere un form a partir de cette classe
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        $userRepository = $entityManager->getRepository(User::class);
        $users = $userRepository->findAll();

        // si le form est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // on récup les données du form
            $user = $form->getData();
            /* It's hashing the password. */
            // mot de passe de base Azerty14!
            $password = $encoder->hashPassword($user, 'Azerty14!');
            $user->setPassword($password);
            /* It's saving the data to the database. */

            //
            $entityManager = $doctrine->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            
            return $this->redirectToRoute('app_admin');
        }

        return $this->render('admin/modification/index.html.twig', [
            'controller_name' => 'AdminController',
            'form' => $form,
            'users' => $users
        ]);
    }
}
